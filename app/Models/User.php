<?php

namespace App\Models;

use App\Actions\Core\NotifyUser;
use App\Enums\GradeLevel;
use App\Helpers\HasProfilePhoto;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Lang;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['profile_photo_url'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone' => 'encrypted',
        'carrier' => 'encrypted',
        'school' => 'encrypted',
        'google_id' => 'encrypted',
        'google_email' => 'encrypted',
        'grade_level' => GradeLevel::class,
    ];

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

    protected static function booted(): void
    {
        //Run upon creation of a new user model
        static::created(function (User $user) {
            $user->settings()->create();
            $user->save();
        });

        static::deleting(function (User $user) {
            $user->settings()->delete();
        });
    }

    protected function name(): Attribute
    {
        return new Attribute(
            get: fn() => "{$this->firstname} {$this->lastname}"
        );
    }

    protected function hasPassword(): Attribute
    {
        return new Attribute(
            get: fn() => isset($this->password) && strlen($this->password) > 0
        );
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'user_id');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(Classes::class, 'user_id');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(ClassSchedule::class)->with('times');
    }

    public function invites(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)->wherePivot('accepted', 0);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)->wherePivot('accepted', 1);
    }

    public function settings(): HasOne
    {
        return $this->hasOne(UserSettings::class);
    }

    public function canAccessFilament(): bool
    {
        return $this->filament_user;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->getProfilePhotoUrlAttribute();
    }

    /**
     * Override the default password reset email
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $body =
            'You received this email because you requested a password reset for your account. <br> ' .
            Lang::get(
                'This password reset link will expire in :count minutes.',
                [
                    'count' => config(
                        'auth.passwords.' .
                            config('auth.defaults.passwords') .
                            '.expire'
                    ),
                ]
            );

        $link = url(
            route(
                'password.reset',
                [
                    'token' => $token,
                    'email' => $this->email,
                ],
                false
            )
        );

        NotifyUser::createNotification(
            [
                'subject' => 'Reset your password',
                'heading' => 'Reset your password',
                'body' => $body,
                'link' => $link,
                'link_title' => 'Reset Password',
                'footer' =>
                    'If you did not request a password reset, no further action is required. 
                        If you\'re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: ' .
                    $link,
                'icon' => 'vpn_key',
                'hide_default_footer' => false,
            ],
            $this
        )->sendEmail();
    }
}
