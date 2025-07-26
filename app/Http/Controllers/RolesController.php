<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveRoleRequest;
use App\Models\Role;
use App\Services\EntityManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RolesController extends Controller
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): Response
    {
        $paginator = $this->entityManager->setModel(Role::class)->getPage();

        return Inertia::render('roles/Index', compact('paginator'));
    }

    public function create(): Response
    {
        return Inertia::render('roles/Create');
    }

    public function store(SaveRoleRequest $request): RedirectResponse
    {
        $this->entityManager->setModel(Role::class)->create($request->validated());

        return to_route('roles.index');
    }

    public function edit(Role $role): Response
    {
        return Inertia::render('roles/Edit', compact('role'));
    }

    public function update(SaveRoleRequest $request, Role $role): RedirectResponse
    {
        $this->entityManager->setModel($role)->update($request->validated());

        return to_route('roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->entityManager->setModel($role)->destroy();

        return to_route('roles.index');
    }
}
