<?php

namespace App\Services;

use App\Repositories\OrganizationRepository;
use App\Repositories\RoleRepository;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;
use App\Models\Permission;


class RoleService
{

    // private $models = [
    //     'user',
    //     'department',
    //     'role',
    //     'project',
    //     'action-item',
    //     'kpi',
    //     'report',
    //     'attachment',
    //     'comment'
    // ];

    // private $permissions = [
    //     'index',
    //     'create',
    //     'read',
    //     'update',
    //     'delete'
    // ];

    protected $roleRepository;
    protected $organizationRepository;

    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
        $this->organizationRepository = new OrganizationRepository();
    }

    public function all($organizationId = null)
    {

        if($organizationId)
        {
            $organization = $this->organizationRepository->find($organizationId);
            return $organization->roles()
                ->withCount(['users'])
                ->with(['permissions' => function($query) {
                    return $query->select(['id', 'display_name']);
                }])
                ->get();
        }

        return $this->roleRepository->all();
    }

    public function create($data, $organization = null)
    {

        $permissions = isset($data['permissions']) ? $data['permissions'] : $this->getDefaultPermissions();

        if(!isset($data['display_name']))
        {
            $data['display_name'] = ucfirst($data['name']);
        }

        $role = $this->roleRepository->create($data);
        $role->syncPermissions($permissions);


        if($organization)
        {
            //$organization = $this->organizationRepository->with(['roles'])->find($organizationId);
            $organization->roles()->attach($role);
        }

        return $role;
    }

    public function update($data, $id)
    {
        $role = $this->roleRepository->find($id);
        $role->syncPermissions($data['permissions']);
        $role->fill($data)
            ->save();
        return $role;
    }

    public function delete($id)
    {
        return $this->roleRepository->delete($id);
    }


    public function getDefaultPermissions()
    {
        // $permissions = [];
        // foreach ($this->models as $model)
        // {
        //     foreach ($this->permissions as $permission)
        //     {
        //         $permissions[] = $permission . '.' . $model;
        //     }
        // }

        return Permission::all();
    }

    // public function createDefaultPermissions()
    // {
    //     $permissions = [];
    //     foreach ($this->models as $model)
    //     {
    //         foreach ($this->permissions as $permission)
    //         {
    //             $permissions[] = Permission::create(['name' =>  $permission . '.' . $model]);
    //         }
    //     }
    // }

}