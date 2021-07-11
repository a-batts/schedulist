<?php

namespace App\Helpers;

use Filament\AvatarProviders\Contracts\AvatarProvider;
use Filament\Models\Contracts\FilamentUser;

class UiAvatarProvider implements AvatarProvider
{
    public function get(FilamentUser $user, $size = 48, $dpr = 1)
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=FFFFFF&background=04B97F&bold=true' . $size * $dpr;
    }
}
