<?php

namespace App\Services;

use function dd;
use function session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleService
{
    function __construct()
    {
    }

    public function all()
    {
        $organization = session('organization');
        return [];
//        return $organization->roles;
//            ->with(['permissions' => function($query) {
//                $query->pluck('name');
//            }])->get();

//        return Role::whereHas('organization', function ($query) use ($organization) {
//            $query->where('subdomain', '=', $organization->subdomain);
//        })->get();

//        return Role::withCount(['users'])
//            ->with(['permissions' => function($query) {
//                $query->pluck('name');
//            }])->get();
    }

    public function create($data)
    {
        $permissions = $data['permissions'];

        $role  = Role::create(['name' => $data['name']]);
        $role->syncPermissions($permissions);

        $organization = session('organization');
        $organization->roles()->attach($role);

        return $role;
    }

    public function update($data, $id)
    {
        $role = Role::findById($id);
        return $role->fill($data)->save();
    }

    public function delete($id)
    {
        return Role::destroy($id);
    }


    // Create permissions for organization
    // Call this method after a organization is created.
    public function createPermissions($subdomain)
    {
        $models = [
            'user',
            'department',
            'role',
            'project',
            'action-item',
        ];

        $permissions = [
            'create',
            'read',
            'update',
            'delete'
        ];

        foreach ($models as $model)
        {
            foreach ($permissions as $permission)
            {
                Permission::create(['name' => $subdomain . '.' . $model . '.' . $permission]);
            }
        }
    }

}