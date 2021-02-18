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
        Artisan::call('cache:forget spatie.permission.cache');

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

            'activemagazine',

            'creategenre',
            'editgenre',
            'deletegenre',
            'viewgenre'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
