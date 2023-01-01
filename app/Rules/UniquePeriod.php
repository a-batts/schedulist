<?php

namespace App\Rules;

use App\Models\Classes;

use Illuminate\Contracts\Validation\Rule;

use Illuminate\Support\Facades\Auth;

class UniquePeriod implements Rule {
  public $value;

  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct() {
    //
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value) {
    $this->value = $value;
    if ($value < 1)
      return false;
    return !Classes::where(['period' => $value, 'user_id' => Auth::id()])->exists();
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message() {
    if ($this->value < 1)
      return 'Invalid period';
    else
      return 'Period already used';
  }
}
