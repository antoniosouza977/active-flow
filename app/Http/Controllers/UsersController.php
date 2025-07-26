<?php

namespace App\Http\Controllers;

use App\Actions\Records\GetUserPage;
use App\Actions\Records\CreateUser;
use App\Actions\Records\ToggleUserActivation;
use App\Actions\Records\UpdateUser;
use App\Http\Requests\SaveUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, GetUserPage $getUserPage): Response
    {
        $paginator = $getUserPage->handle($request->all());

        return Inertia::render('users/Index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('users/Create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws Exception
     */
    public function store(SaveUserRequest $request, CreateUser $createUser): RedirectResponse
    {
        try {
            $createUser->handle($request->validated());

            return to_route('users.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): Response
    {
        return Inertia::render('users/Edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveUserRequest $request, User $user, UpdateUser $updateUser): RedirectResponse
    {
        try {
            $updateUser->handle($user, $request->validated());

            return to_route('users.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return back();
        }
    }

    public function activate(User $user, ToggleUserActivation $toggleUserActivation): RedirectResponse
    {
        $toggleUserActivation->handle($user, true);

        return back();
    }

    public function inactivate(User $user, ToggleUserActivation $toggleUserActivation): RedirectResponse
    {
        $toggleUserActivation->handle($user, false);

        return back();
    }
}
