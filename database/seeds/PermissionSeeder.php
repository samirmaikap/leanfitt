<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        $models = config('permission.models');
        $actions = config('permission.actions');
        $permissions = [];

        foreach ($models as $model) {
        	
        	foreach ($actions as $action) {
        		$permission = new \App\Models\Permission();
        		$permission->name = $action . '.' . $model;
        		$permission->display_name = ucfirst($action) . ' ' . ucfirst($model);
        		$permission->save();

        		$permissions[] = $permission;
        	}
        }

		// Create SuperAdmin role
        $superAdmin = new \App\Models\Role();
        $superAdmin->name = "SuperAdmin";
        $superAdmin->display_name = "SuperAdmin";
        $superAdmin->description  = 'User is a Super Admin with global access';
        $superAdmin->save();

        // Grant all permission to SuperAdmin
        $superAdmin->attachPermissions($permissions);

        DB::table('role_user')->insert([
            [
                'user_id'=>1,
                'role_id'=>1,
                'user_type'=>'App\Models\User'
            ],
        ]);
    }
}
