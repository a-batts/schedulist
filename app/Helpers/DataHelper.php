<?php

namespace App\Helpers;

use App\Enums\DataCategory;
use App\Enums\EventFrequency;
use App\Models\User;
use App\Models\Event;
use App\Models\EventUser;
use Error;
use Illuminate\Support\Facades\Auth;

class DataHelper
{
    private array $isoDays = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
    ];

    function __construct(private User $user)
    {
        $user->load([
            'assignments',
            'assignments.notes',
            'classes',
            'events',
            'events.creator',
            'schedules',
        ]);
    }

    /**
     * Delete a specified category's data
     *
     * @param DataCategory $dataCategory
     * @throws Error
     * @return void
     */
    public function deleteData(DataCategory $dataCategory): void
    {
        switch ($dataCategory) {
            case DataCategory::Assignment:
                foreach ($this->user->assignments as $assignment) {
                    $assignment->delete();
                }
                break;
            case DataCategory::Classes:
                foreach ($this->user->classes as $class) {
                    $class->delete();
                }
                break;
            case DataCategory::Event:
                Event::where('owner', $this->user->id)->delete();
                EventUser::where('user_id', $this->user->id)->delete();
                break;
            case DataCategory::Schedule:
                foreach ($this->user->schedules as $schedule) {
                    $schedule->delete();
                }
                break;
            default:
                throw new Error('Invalid category of data to download');
        }
    }

    /**
     * Retrieve a specified category's data
     *
     * @param DataCategory $dataCategory
     * @return array
     */
    public function getData(DataCategory $dataCategory): array
    {
        $data = [];

        switch ($dataCategory) {
            case DataCategory::Assignment:
                $classes = $this->user->classes;

                foreach ($this->user->assignments as $assignment) {
                    $notes = [];
                    foreach ($assignment->notes as $note) {
                        $notes[] = ['content' => $note->content];
                    }

                    $data[] = [
                        'name' => $assignment->name,
                        'class' => [
                            'name' =>
                                $classes->find($assignment->class_id) != null
                                    ? $classes->find($assignment->class_id)[
                                        'name'
                                    ]
                                    : '',
                        ],
                        'description' => $assignment->description,
                        'due' => $assignment->due,
                        'link' => $assignment->link,
                        '' => strtolower($assignment->status->name),
                        'notes' => $notes,
                    ];
                }
                break;
            case DataCategory::Classes:
                foreach ($this->user->classes as $class) {
                    $links = [];
                    foreach ($class->links as $link) {
                        $links[] = [
                            'name' => $link->name,
                            'link' => $link->link,
                        ];
                    }

                    $times = [];
                    foreach ($class->times as $time) {
                        $times[] = [
                            'day_of_week' => $this->isoDays[$time->day_of_week],
                            'start_time' => $time->start_time,
                            'end_time' => $time->end_time,
                        ];
                    }

                    $data[] = [
                        'name' => $class->name,
                        'period' => $class->period,
                        'location' => $class->class_location,
                        'teacher' => [
                            'name' => $class->teacher,
                            'email' => $class->teacher_email,
                        ],
                        'video_link' => $class->video_link,
                        'color' => $class->color,
                        'schedule_id' => $class->schedule_id,
                        'links' => $links,
                        'times' => $times,
                    ];
                }
                break;
            case DataCategory::Event:
                foreach ($this->user->events as $event) {
                    $eventData = [
                        'name' => $event->name,
                        'category' => $event->category->formattedName(),
                        'time' => [
                            'date' => $event->date,
                            'start' => $event->start_time,
                            'end' => $event->end_time,
                        ],
                        'sharing' => [
                            'is_owner' =>
                                (string) Auth::id() == $event->creator->id,
                            'owner' => $event->creator->name,
                        ],
                        'color' => $event->color,
                        'frequency' => [
                            'repeats' => strtolower($event->frequency->name),
                            'interval' => $event->interval,
                            'end_date' => $event->end_date ?? 'never',
                        ],
                    ];

                    if ($event->frequency == EventFrequency::Weekly) {
                        $eventData['frequency']['days'] = json_encode(
                            $event->days
                        );
                    }

                    $data[] = $eventData;
                }
                break;
            case DataCategory::ProfileData:
                $user = $this->user;
                $data = [
                    'first_name' => $user->firstname,
                    'last_name' => $user->lastname,
                    'email' => $user->email,
                    'phone' => [
                        'number' => $user->phone,
                        'carrier' => $user->carrier,
                    ],
                    'school' => [
                        'name' => $user->school,
                        'gradeLevel' => $user->grade_level->formattedName(),
                    ],
                ];
                break;
            case DataCategory::Schedule:
                foreach ($this->user->schedules as $schedule) {
                    $data[] = [
                        'name' => $schedule->name,
                        'start_date' => $schedule->start_date,
                        'end_date' => $schedule->end_date,
                    ];
                }
                break;
            default:
                break;
        }
        return $data;
    }
}
