<?php

namespace App\Actions\Records;

use App\Models\User;

class ToggleUserActivation
{
    public function handle(User $user, bool $activate): bool
    {
        return $user->update(['is_active' => $activate]);
    }
}
