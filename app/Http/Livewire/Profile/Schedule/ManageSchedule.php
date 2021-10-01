<?php

namespace App\Http\Livewire\Profile\Schedule;

use App\Helpers\ClassScheduleHelper;
use App\Models\ClassSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ManageSchedule extends Component {

  public $classes;

  public $schedule;

  public $scheduleType;

  public $blocks = [
    'block_1' => [
      'classes' => [],
      'times' => [],
    ],
    'block_2' => [
      'classes' => [],
      'times' => [],
    ],
    'block_3' => [
      'classes' => [],
      'times' => [],
    ],
    'block_4' => [
      'classes' => [],
      'times' => [],
    ],
    'block_5' => [
      'classes' => [],
      'times' => [],
    ],
    'block_6' => [
      'classes' => [],
      'times' => [],
    ],
    'block_7' => [
      'classes' => [],
      'times' => [],
    ],
  ];

  public $possibleNumberBlocks = [1, 2, 3, 4, 5, 6, 7];

  public $scheduleTypes = ['Block', 'Fixed', /*'Custom'*/];

  private $days = ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun'];

  public $errorMessages;

  protected $rules = [
    'schedule.schedule_type' => 'required',
    'schedule.number_blocks' => 'required',
  ];

  public function mount() {
    $schedule = Auth::User()->classSchedule()->first();
    if ($schedule == null) {
      $schedule = new ClassSchedule();
      $schedule->schedule_type = 'fixed';
      $schedule->number_blocks = 7;
      $schedule->schedule_start = Carbon::now()->toDateTimeString();
      $schedule->save();

      if (Auth::User()->classSchedule()->first() == null)
        DB::table('class_schedule_user')->insert([
          'user_id' => Auth::User()->id,
          'class_schedule_id' => $schedule->id,
        ]);

      $this->schedule = $schedule;

      $schedule = $schedule->toArray();
    } else {
      if ($schedule->schedule_type == 'fixed')
        $schedule->number_blocks = 7;
      $this->schedule = $schedule;

      $schedule = $schedule->toArray();
      if ($schedule != null) {
        for ($i = 1; $i <= 7; $i++) {
          $block = $schedule['block_' . $i];
          if ($block != null) {
            $block = explode('|', $block);
            $this->blocks['block_' . $i]['classes'] = explode(',', $block[0]);
            $this->blocks['block_' . $i]['times'] = explode(',', $block[1]);
            foreach ($this->blocks['block_' . $i]['times'] as $index => $time) {
              if (substr($time, 0, 2) < 12)
                $currentDtForm = 'AM';
              else
                $currentDtForm = 'PM';
              $this->blocks['block_' . $i]['times'][$index] = $this->formatTime($time, $currentDtForm);
            }
          }
        }
      }
    }

    $this->scheduleType = ucfirst($schedule['schedule_type']);
    $this->classes = Auth::User()->classes->toArray();
  }

  public function formatTime($time, $currentDtForm = null) {
    if ($currentDtForm == null) $currentDtForm = Carbon::now()->format('A');
    $len = strlen($time);
    //Check if time exists
    if ($time == null)
      return null;
    //Check if only hour format was inputted
    if ($len <= 2 && $len > 0) {
      if (intval($time) > 0 && intval($time) <= 12) {
        $time .= ':00 ' . $currentDtForm;
      } else if (intval($time) > 12 && intval($time) <= 23)
        $time = intval($time) - 12 . ':00 ' . 'PM';
      else
        return null;
      return $time;
    }
    //Check if colon is present
    $len = strlen($time);
    if (strpos($time, ':') === false) {
      $hasSpace = strpos($time, ' ');
      if ($hasSpace)
        $time = substr($time, 0, $hasSpace);
      if ($len == 3)
        $time = substr($time, 0, 1) . ':' . substr($time, 1);
      else if ($len == 4)
        $time = substr($time, 0, 2) . ':' . substr($time, 2);
    }

    $len = strlen($time);
    $split = explode(':', $time);

    //Check if time split properly
    if (!isset($split[1]))
      return null;

    //Check if hours and minutes are formatted properly
    if ($split[0] == 0 || 00) {
      $split[0] = 12;
      $currentDtForm = 'AM';
    }
    if ($split[0] > 12 && $split[0] < 24) {
      $split[0] = $split[0] - 12;
      $currentDtForm = 'PM';
    }
    if ($split[0] > 23 || $split[0] < 0)
      $split[0] = Carbon::now()->format('h');

    if ($split[1] > 59 || $split[1] < 0)
      return null;
    if (is_numeric(substr($split[1], 2, 1)))
      return null;

    //Check if AM and PM are formatted properly
    if (strtoupper(substr($split[1], 2)) == 'AM')
      $split[1] = substr($split[1], 0, 2) . ' AM';
    if (strtoupper(substr($split[1], 2)) == 'PM')
      $split[1] = substr($split[1], 0, 2) . ' PM';
    if (strtoupper(substr($split[1], 2)) != ' AM' && strtoupper(substr($split[1], 2)) != ' PM') {
      $split[1] = substr($split[1], 0, 2) . ' ' . $currentDtForm;
    } else
      $split[1] = substr($split[1], 0, 2) . ' ' . strtoupper(substr($split[1], 3));

    //Trim leading zero
    if (substr($split[0], 0, 1) == 0)
      $split[0] = substr($split[0], 1);

    $time = implode(':', $split);

    //Check if space exists
    if (substr($split[1], 2, 1) != ' ')
      return null;

    //Check if letters are contained in time part of string
    if (!is_numeric($split[0]) || !is_numeric(substr($split[1], 0, 2)))
      return null;

    //Check if the string is too long and needs to be trimmed
    if (strlen($split[0]) == 1) {
      if (strlen($time) > 7)
        $time = substr($time, 0, 7);
    } else if (strlen($split[0]) == 2) {
      if (strlen($time) > 8)
        $time = substr($time, 0, 8);
    }

    return $time;
  }

  public function removeClass($block, $classId) {
    $blocks = $this->blocks;
    $blockArray = $blocks['block_' . $block];

    $index = array_search(strval($classId), $blockArray['classes']);
    if ($index === false) {
      //Does this need to be handled?
    } else {
      $blockArray['classes'][$index] = '';
      $blockArray['times'][$index * 2] = '';
      $blockArray['times'][$index * 2 + 1] = '';

      $this->blocks['block_' . $block] = $blockArray;
    }
  }

  public function saveSchedule() {
    $blocks = $this->blocks;
    $schedule = $this->schedule;

    for ($i = 1; $i <= 7; $i++) {
      if ($schedule->number_blocks < $i) {
        $schedule->{'block_' . $i} = null;
      } else {
        $block = $blocks['block_' . $i];
        foreach ($block['classes'] as $index => $class) {
          if ($block['times'][$index * 2] == '' && $block['times'][$index * 2 + 1] == '') {
            $this->dispatchBrowserEvent('class-removed', ['block' => $i, 'index' => $index]);
            $this->blocks['block_' . $i]['classes'][$index] = '';
          } elseif ($block['times'][$index * 2] == '' || $block['times'][$index * 2 + 1] == '') {
            $this->addError('class' . $class . 'block' . $i . 'error', 'Make sure both a start and end time are set');
            return;
          }
        }
        $classes = implode(',', $block['classes']);
        foreach ($block['times'] as $index => $time) {
          if ($time != '')
            $block['times'][$index] = Carbon::createFromFormat('g:i A', $time)->format('Hi');
        }
        $times = implode(',', $block['times']);
        $schedule->{'block_' . $i} = $classes . '|' . $times;
      }
    }
    if ($schedule->schedule_type == 'fixed')
      $schedule->number_blocks = 7;

    $schedule->save();

    $this->emit('toastMessage', 'Schedule was successfully saved');
  }

  public function updateTime($classId, $block, $time, $type) {
    $blockArray = $this->blocks['block_' . $block];
    $newTime = $this->formatTime($time);
    if ($newTime == null && $time != null) {
      $this->addError('class' . $classId . 'block' . $block . 'error', 'Invalid ' . $type . ' time inputted');
      return;
    }
    $index = array_search(strval($classId), $blockArray['classes']);
    if ($index === false) {
      array_push($blockArray['classes'], strval($classId));
      if ($type == 'start')
        array_push($blockArray['times'], $newTime, '');
      else
        array_push($blockArray['times'], '', $newTime);
    } else {
      if ($type == 'start') {
        if ($time == null)
          $blockArray['times'][$index * 2] = '';
        elseif ($blockArray['times'][$index * 2 + 1] == '')
          $blockArray['times'][$index * 2] = $newTime;
        else {
          $start = Carbon::createFromFormat('g:i A', $newTime);
          $end = Carbon::createFromFormat('g:i A', $blockArray['times'][$index * 2 + 1]);
          if ($start < $end)
            $blockArray['times'][$index * 2] = $newTime;
          else
            $this->addError('class' . $classId . 'block' . $block . 'error', 'The start time must be before the end time');
        }
      } else {
        if ($time == null)
          $blockArray['times'][$index * 2 + 1] = '';
        elseif ($blockArray['times'][$index * 2] == '')
          $blockArray['times'][$index * 2 + 1] = $newTime;
        else {
          $start = Carbon::createFromFormat('g:i A', $blockArray['times'][$index * 2]);
          $end = Carbon::createFromFormat('g:i A', $newTime);
          if ($start < $end)
            $blockArray['times'][$index * 2 + 1] = $newTime;
          else
            $this->addError('class' . $classId . 'block' . $block . 'error', 'The start time must be before the end time');
        }
      }
    }
    $this->blocks['block_' . $block] = $blockArray;
  }

  public function setNumberBlocks($numberBlocks) {
    $this->schedule->number_blocks = $numberBlocks;
  }

  public function setScheduleType($scheduleType) {
    $this->schedule->schedule_type = strtolower($scheduleType);
  }

  function getDays() {
    return $this->days;
  }

  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();
    return view('livewire.profile.schedule.manage-schedule');
  }
}
