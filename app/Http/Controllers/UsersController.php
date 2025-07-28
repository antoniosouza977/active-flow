<?php

namespace App\Http\Controllers;

use App\Actions\AssignUserRoles;
use App\Http\Requests\SaveUserRequest;
use App\Models\User;
use App\Services\EntityManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): Response
    {
        $paginator = $this->entityManager->setBuilder(User::query()->orderBy('name'))->getPage();

        return Inertia::render('users/Index', compact('paginator'));
    }

    public function create(): Response
    {
        return Inertia::render('users/Create');
    }

    public function store(SaveUserRequest $request): RedirectResponse
    {
        $this->entityManager->setModel(User::class)->create($request->validated());

        return to_route('users.index');
    }

    public function edit(User $user): Response
    {
        $user->load('roles');

        return Inertia::render('users/Edit', compact('user'));
    }

    public function update(SaveUserRequest $request, User $user, AssignUserRoles $assignUserRoles): RedirectResponse
    {
        $this->entityManager->setModel($user)->update($request->except('roles'));

        if ($request->has('roles')) {
            $assignUserRoles->handle($user, $request->get('roles'));
        }

        return to_route('users.index');
    }

    public function activate(User $user): RedirectResponse
    {
        $this->entityManager->setModel($user)->update(['is_active' => true]);

        return back();
    }

    public function inactivate(User $user): RedirectResponse
    {
        $this->entityManager->setModel($user)->update(['is_active' => false]);

        return back();
    }
}
