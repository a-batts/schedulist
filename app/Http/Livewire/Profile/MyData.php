<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use ZipArchive;
use Illuminate\Support\Facades\DB;
use App\Models\EventUser;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MyData extends Component {

    public User $user;

    /**
     * Holds information about user's existing backup 
     * 
     * @var array
     */

    public array $existingBackup;

    /**
     * Selected categories of data to be archived
     *
     * @var array
     */
    public array $selectedData = [];

    private array $isoDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    /**
     * Create zip archive and return download to user
     *
     * @return void|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function createArchive(): ?BinaryFileResponse {
        $zip = new ZipArchive;
        $fileName = Auth::user()->firstname . '_' . Carbon::now()->toDateString() . '_' . rand(1, 99) . '_archive.zip';

        if ($zip->open(storage_path('app/exported-archives/' . $fileName), ZipArchive::CREATE) === true) {
            $archive = DB::table('user_archives')->where('user_id', Auth::id())->first();

            if ($archive !== null && $archive->filename != $fileName)
                unlink(storage_path('app/exported-archives/' . $archive->filename));
            DB::table('user_archives')->where('user_id', Auth::id())->delete();

            foreach ($this->selectedData as $category)
                $zip = $this->getData($category, $zip);

            $zip->close();

            DB::table('user_archives')->insert([
                'user_id' => Auth::id(),
                'filename' => $fileName,
                'backup_contains' => implode(',', $this->selectedData),
                'created_at' => Carbon::now(),
            ]);

            $this->dispatchBrowserEvent('started-download');
            return response()->download(storage_path('app/exported-archives/' . $fileName));
        } else {
            $this->emit('toastMessage', 'Something went wrong. Please try that action again.');
        }
    }

    /**
     * Delete specifed category of data
     *
     * @param string $category
     * @return void
     */
    public function deleteData(string $category): void {
        switch ($category) {
            case 'assignments':
                foreach (Auth::user()->assignments as $assignment)
                    $assignment->delete();
                $this->emit('toastMessage', 'Your assignments have been successfully deleted');
            case 'classes':
                foreach (Auth::user()->classes as $class)
                    $class->delete();
                $this->emit('toastMessage', 'Your classes have been successfully deleted');
                break;
            case 'events':
                Event::where('owner', Auth::id())->delete();
                EventUser::where('user_id', Auth::id())->delete();
                $this->emit('toastMessage', 'Your events have been successfully deleted and unshared');
                break;
            case 'schedules':
                foreach (Auth::user()->schedules as $schedule)
                    $schedule->delete();
                $this->emit('toastMessage', 'Your schedules have been successfully deleted');
                break;
        }
    }

    public function getData(string $category, ZipArchive $zip): ZipArchive {
        $data = [];
        switch ($category) {
            case 'assignments':
                $classes = $this->user->classes;

                foreach ($this->user->assignments as $assignment) {
                    $notes = [];
                    foreach ($assignment->notes as $note)
                        $notes[] = ['content' => $note->content];

                    $data[] = [
                        'name' => $assignment->name,
                        'class' => [$classes->find($assignment->class_id) != null ? $classes->find($assignment->class_id)['name'] : ''],
                        'description' => $assignment->description,
                        'due' => $assignment->due,
                        'link' => $assignment->link,
                        '' => strtolower($assignment->status->name),
                        'notes' => $notes
                    ];
                }
                $zip->addFromString($category . '.json', json_encode($data));
                break;

            case 'classes':
                foreach ($this->user->classes as $class) {
                    $links = [];
                    foreach ($class->links as $link)
                        $links[] = [
                            'name' => $link->name,
                            'link' => $link->link,
                        ];

                    $times = [];
                    foreach ($class->times as $time)
                        $times[] = [
                            'day_of_week' => $this->isoDays[$time->day_of_week],
                            'start_time' => $time->start_time,
                            'end_time' => $time->end_time,
                        ];

                    $data[] = [
                        'name' => $class->name,
                        'period' => $class->period,
                        'location' => $class->class_location,
                        'teacher' => [
                            'teacherName' => $class->teacher,
                            'teacherEmail' => $class->teacher_email,
                        ],
                        'videoLink' => $class->video_link,
                        'color' => $class->color,
                        'schedule_id' => $class->schedule_id,
                        'links' => $links,
                        'times' => $times,
                    ];
                }
                $zip->addFromString($category . '.json', json_encode($data));
                break;

            case 'events':
                foreach ($this->user->events as $event) {
                    $eventData = [
                        'name' => $event->name,
                        'category' => $event->category,
                        'time' => [
                            'date' => $event->date,
                            'start' => $event->start_time,
                            'end' => $event->end_time,
                        ],
                        'sharing' => [
                            'isOwner' => (string) Auth::id() == $event->creator->id,
                            'owner' => $event->creator->name,
                        ],
                        'color' => $event->color,
                    ];
                    if (boolval($event->reoccuring)) {
                        $frequencies = [1 => 'every day', 7 => 'every week', 14 => 'every two weeks', 31 => 'every month'];
                        if (strlen($event->days) > 1) {
                            $days = explode(',', $event->days);
                            for ($i = 0; $i < count($days); $i++)
                                $days[$i] = $this->isoDays[$days[$i]];
                        } else
                            $days[0] = $event->days;

                        $eventData['reoccuring'] = [
                            'frequency' => $frequencies[$event->frequency],
                            'days' => $days,
                        ];
                    } else
                        $eventData['reoccuring'] = 'false';

                    $data[] = $eventData;
                }
                $zip->addFromString($category . '.json', json_encode($data));
                break;

            case 'schedules':
                foreach ($this->user->schedules as $schedule)
                    $data[] = [
                        'name' => $schedule->name,
                        'start_date' => $schedule->start_date,
                        'end_date' => $schedule->end_date,
                    ];
                $zip->addFromString($category . '.json', json_encode($data));
                break;

            case 'profile':
                $user = $this->user;
                $data = [
                    'firstName' => $user->firstname,
                    'lastName' => $user->lastname,
                    'email' => $user->email,
                    'phone' => [
                        'number' => $user->phone,
                        'carrier' => $user->carrier,
                    ],
                    'school' => [
                        'name' => $user->school,
                        'gradeLevel' => $user->grade_level->formattedName()
                    ]
                ];
                $zip->addEmptyDir('profile');
                $zip->addFromString('profile/profile-info.json', json_encode($data));
                if ($user->avatar !== null)
                    $zip->addFile(public_path('storage/' . $user->profile_photo_path), 'profile/profile-photo.' . explode('.', $user->profile_photo_path)[1]);
        }
        return $zip;
    }

    /**
     * Redownload the last user created archive
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function redownload(): BinaryFileResponse {
        $this->dispatchBrowserEvent('finished-redownload');
        return response()->download(storage_path('app/exported-archives/' . $this->existingBackup['filename']));
    }

    public function render() {
        $this->user = Auth::user()->with(['assignments', 'classes', 'events', 'schedules'])->first();

        $archiveRecord = DB::table('user_archives')->where('user_id', $this->user->id)->first();
        if ($archiveRecord != null) {
            $contains = '';
            $exploded = explode(',', $archiveRecord->backup_contains);
            sort($exploded);
            foreach ($exploded as $key => $data) {
                if ($key != count($exploded) - 1)
                    $contains .= $data . ', ';
                else if (count($exploded) > 1)
                    $contains .= ' and ' . $data;
                else
                    $contains = $data;
            }
            $existingBackup = [
                'filename' => $archiveRecord->filename,
                'created' => Carbon::parse($archiveRecord->created_at)->format('F jS, Y'),
                'daysOld' => Carbon::parse($archiveRecord->created_at)->diffInDays(Carbon::now()),
                'contains' => $contains,
            ];
            $this->existingBackup = $existingBackup;
        }
        return view('livewire.profile.my-data')
            ->layout('layouts.app')
            ->layoutData(['title' => 'Your Data']);
    }
}
