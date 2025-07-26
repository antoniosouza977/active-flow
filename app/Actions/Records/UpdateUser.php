<?php

namespace App\Actions\Records;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UpdateUser
{

    public function handle(User $user, array $data): bool
    {
        return $user->fill($data)->save();
    }

}
