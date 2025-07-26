<?php

namespace App\Actions\Records;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class GetUserPage
{
    public function handle(array $filters = []): LengthAwarePaginator
    {
        return User::query()->orderBy('name')->paginate(10);
    }
}
