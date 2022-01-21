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

class MyData extends Component {

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

    public $user;

    /**
     * Create zip archive and return download to user
     *
     * @return void|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function createArchive() {
        $zip = new ZipArchive;
        $fileName = Auth::user()->firstname . '_' . Carbon::now()->toDateString() . '_' . rand(1, 99) . '_archive.zip';
        if ($zip->open(storage_path('app/exported-archives/' . $fileName), ZipArchive::CREATE) === TRUE) {
            $archiveRecord = DB::table('user_archives')->where('user_id', Auth::user()->id)->first();
            if ($archiveRecord !== null && $archiveRecord->filename != $fileName)
                unlink(storage_path('app/exported-archives/' . $archiveRecord->filename));
            DB::table('user_archives')->where('user_id', Auth::user()->id)->delete();

            foreach ($this->selectedData as $category)
                $zip = $this->getData($category, $zip);

            $zip->close();

            DB::table('user_archives')->insert([
                'user_id' => Auth::user()->id,
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
    public function deleteData(string $category) {
        switch ($category) {
            case 'assignments':
                Auth::user()->assignments()->delete();
                $this->emit('toastMessage', 'Your assignments have been successfully deleted');
            case 'classes':
                $classes = Auth::user()->classes()->with('links')->get();
                foreach ($classes as $class)
                    $class->links()->delete();
                Auth::user()->classes()->delete();
                $this->emit('toastMessage', 'Your classes have been successfully deleted');
                break;
            case 'events':
                Event::where('owner', Auth::user()->id)->delete();
                EventUser::where('user_id', Auth::user()->id)->delete();
                $this->emit('toastMessage', 'Your events have been successfully deleted and unshared');
                break;
        }
    }

    public function getData(string $category, ZipArchive $zip) {
        $data = [];
        switch ($category) {
            case 'assignments':
                $assignments = Auth::user()->assignments()->get(['classid', 'assignment_name', 'assignment_link', 'description', 'status', 'due']);
                $classes = Auth::user()->classes()->get(['id', 'name']);
                foreach ($assignments as $assignment) {
                    array_push($data, [
                        'name' => $assignment->assignment_name != null ? Crypt::decryptString($assignment->assignment_name) : '',
                        'class' => [$classes->find($assignment->classid) != null ? $classes->find($assignment->classid)['name'] : ''],
                        'description' => $assignment->description != null ? Crypt::decryptString($assignment->description) : '',
                        'due' => $assignment->due,
                        'link' => $assignment->assignment_link != null ? Crypt::decryptString($assignment->assignment_link) : '',
                        'status' => $assignment->status == 'done' ? 'done' : 'incomplete',
                    ]);
                }
                $zip->addFromString($category . '.json', json_encode($data));
                break;
            case 'classes':
                $classes = Auth::User()->classes()->orderBy('name', 'asc')->with('links')->get();
                foreach ($classes as $class) {
                    $linkData = [];
                    foreach ($class->links as $link)
                        array_push($linkData, [
                            'name' => $link->name,
                            'link' => $link->link != null ? Crypt::decryptString($link->link) : '',
                        ]);
                    array_push($data, [
                        'name' => $class->name,
                        'period' => $class->period,
                        'location' => $class->class_location != null ? Crypt::decryptString($class->class_location) : '',
                        'teacher' => [
                            'teacherName' => $class->teacher != null ? Crypt::decryptString($class->teacher) : '',
                            'teacherEmail' => $class->teacher_email != null ? Crypt::decryptString($class->teacher_email) : '',
                        ],
                        'videoLink' => $class->video_link != null ? Crypt::decryptString($class->video_link) : '',
                        'color' => $class->color,
                        'links' => $linkData,
                    ]);
                }
                $zip->addFromString($category . '.json', json_encode($data));
                break;
            case 'class schedule':
                //Finish at some point
                break;
            case 'events':
                $events = Auth::user()->events()->with('users')->get();
                foreach ($events as $event) {
                    $eventData = [
                        'name' => $event->name != null ? Crypt::decryptString($event->name) : '',
                        'category' => $event->category,
                        'time' => [
                            'date' => $event->date,
                            'start' => $event->start_time,
                            'end' => $event->end_time,
                        ],
                        'sharing' => [
                            'isOwner' => (string) Auth::user()->id == $event->users->first()->id,
                            'owner' => $event->users->first()->firstname . ' ' . $event->users->first()->lastname,
                        ],
                        'color' => $event->color,
                    ];
                    if ((bool)$event->reoccuring) {
                        $isoDays = ['M', 'Tu', 'W', 'Th', 'F', 'Sa', 'Su'];
                        $frequencies = [1 => 'every day', 7 => 'every week', 14 => 'every two weeks', 31 => 'every month'];
                        $days = explode(',', $event->days);
                        for ($i = 0; $i < count($days); $i++)
                            $days[$i] = $isoDays[$days[$i]];
                        $eventData['reoccuring'] = [
                            'frequency' => $frequencies[$event->frequency],
                            'days' => $days,
                        ];
                    } else
                        $eventData['reoccuring'] = 'false';
                    array_push($data, $eventData);
                }
                $zip->addFromString($category . '.json', json_encode($data));
                break;
            case 'profile':
                $profile = User::where('id', Auth::user()->id)->get(['firstname', 'lastname', 'email', 'phone', 'carrier', 'school', 'grade_level', 'avatar'])->first();
                $data = [
                    'firstName' => $profile->firstname,
                    'lastName' => $profile->lastname,
                    'email' => $profile->email,
                    'phone' => [
                        'number' => $profile->phone,
                        'carrier' => $profile->carrier,
                    ],
                    'school' => [
                        'name' => $profile->school,
                        'gradeLevel' => $profile->grade_level
                    ]
                ];
                $zip->addEmptyDir('profile');
                $zip->addFromString('profile/profile-info.json', json_encode($data));
                if ($profile->avatar !== null)
                    $zip->addFile(public_path('storage/' . $profile->avatar), 'profile/profile-photo.' . explode('.', $profile->avatar)[1]);
        }
        return $zip;
    }

    /**
     * Redownload the last user created archive
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function redownload() {
        $this->dispatchBrowserEvent('finished-redownload');
        return response()->download(storage_path('app/exported-archives/' . $this->existingBackup['filename']));
    }

    public function render() {
        $archiveRecord = DB::table('user_archives')->where('user_id', Auth::user()->id)->first();
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
        $this->user = Auth::user()->with(['assignments', 'classes', 'events'])->first();
        return view('livewire.profile.my-data')
            ->layout('layouts.app')
            ->layoutData(['title' => 'Your Data']);
    }
}
