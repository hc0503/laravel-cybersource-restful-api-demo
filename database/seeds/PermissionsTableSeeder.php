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
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
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
            'viewgenre',

            'createdocument',
            'editdocument',
            'deletedocument',
            'viewdocument',

            'createslider',
            'editslider',
            'deleteslider',
            'viewslider',

            'createcontactemail',
            'editcontactemail',
            'deletecontactemail',
            'viewcontactemail',

            'viewdisclaimer',
            'editdisclaimer',

            'viewprivacy',
            'editprivacy',

            'editaboutus',
            'viewaboutus',

            'editcontactus',
            'viewcontactus',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
