<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
        $role->givePermissionTo('guest');

        Role::create(['name' => 'Admin']);
        $role->givePermissionTo('manager');
    }
}
