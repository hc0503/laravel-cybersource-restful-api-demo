<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        $role = Role::create(['name' => 'User']);

        $role = Role::create(['name' => 'SuperAdmin']);
        $role->givePermissionTo(Permission::all());
    }
}
