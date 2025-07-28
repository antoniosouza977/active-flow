<?php

namespace App\Actions;

use App\Models\User;

class AssignUserRoles
{
    public function handle(User $user, array $roles): void
    {
        $user->roles()->sync($roles);
    }
}
