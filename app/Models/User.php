<?php

namespace App\Models;

use App\Helpers;

use App\Helpers\HasProfilePhoto;

use Filament\Models\Concerns\IsFilamentUser;
use Filament\Models\Contracts\FilamentUser;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use IsFilamentUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'school',
        'grade_level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function getFilamentAdminColumn(){
      return 'filament_admin';
    }

    public static function getFilamentRolesColumn(){
      return 'filament_roles';
    }

    public static function getFilamentUserColumn(){
      return 'filament_user';
    }

    public static function getFilamentAvatarColumn(){
      return 'profile_photo_path';
    }

    public function getFilamentAvatar(){
      return $this->getProfilePhotoUrlAttribute();
    }

    public function isFilamentAdmin(){
      return $this->filament_admin;
    }

    public function canAccessFilament(){
      return $this->filament_user;
    }

    public function getNumClassesAttribute(){
      return Classes::where('userid', Auth::user()->id)->count();
    }

    public function getNameAttribute(){
      return "{$this->firstname} {$this->lastname}";
    }

    public function setNameAttribute($value){
      if (isset($value)){
        $names = explode(' ', $value);
        $this->attributes['firstname'] = $names[0];
        $this->attributes['lastname'] = $names[1];
      }
    }

    public function getNumAssignmentsAttribute(){
      return Assignment::where(['userid' => Auth::user()->id, 'status' => 'inc'])->count();
    }

    public function getHasPasswordAttribute(){
      return ($this->password !== null);
    }

}
