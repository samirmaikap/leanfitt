<?php

namespace App\Services;

use App\Repositories\OrganizationRepository;
use App\Repositories\RoleRepository;
use function dd;
use function session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleService
{

    private $models = [
        'user',
        'department',
        'role',
        'project',
        'action-item',
        'kpi',
        'report',
        'attachment',
        'comment'
    ];

    private $permissions = [
        'index',
        'create',
        'read',
        'update',
        'delete'
    ];

    protected $roleRepository;
    protected $organizationRepository;

    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
        $this->organizationRepository = new OrganizationRepository();
    }

    public function all()
    {
        $organization = session('organization');
        return $organization->roles()
            ->withCount(['users'])
            ->with(['permissions' => function($query) {
                return $query->select(['id', 'name']);
            }])
            ->get();
    }

    public function create($data, $organizationId)
    {

        $permissions = isset($data['permissions']) ? $data['permissions'] : $this->getDefaultPermissions();

        $role = $this->roleRepository->create(['name' => $data['name']]);
        $role->syncPermissions($permissions);


        $organization = $this->organizationRepository->with(['roles'])->find($organizationId);
        $organization->roles()->attach($role);

        return $role;
    }

    public function update($data, $id)
    {
        $role = $this->roleRepository->find($id);
        $role->syncPermissions($data['permissions']);
        $role->fill(['name' => $data['name']])
            ->save();
        return $role;
    }

    public function delete($id)
    {
        return $this->roleRepository->delete($id);
    }


    public function getDefaultPermissions()
    {
        $permissions = [];
        foreach ($this->models as $model)
        {
            foreach ($this->permissions as $permission)
            {
                $permissions[] = $permission . '.' . $model;
            }
        }
    }

    public function createDefaultPermissions()
    {
        $permissions = [];
        foreach ($this->models as $model)
        {
            foreach ($this->permissions as $permission)
            {
                $permissions[] = Permission::create(['name' =>  $permission . '.' . $model]);
            }
        }
    }

}