<?php

namespace App\Actions\Records;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CreateUser
{

    public function handle(array $data): User|Model
    {
        return User::query()->create($data);
    }

}
