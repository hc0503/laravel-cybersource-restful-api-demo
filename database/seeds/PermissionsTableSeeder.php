<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        $permissions = [
            'createpermission',
            'editpermission',
            'deletepermission',
            'viewpermission',

            'createrole',
            'editrole',
            'deleterole',
            'viewrole',

            'createuser',
            'edituser',
            'deleteuser',
            'viewuser',

            'managelogin',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
