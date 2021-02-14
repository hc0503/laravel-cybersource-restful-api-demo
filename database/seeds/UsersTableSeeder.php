<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $admin = factory(User::class)->create([
            'name' => 'SuperAdmin',
            'email' => 'admin@admin.com'
        ]);
        $admin->assignRole('SuperAdmin');

        $user = factory(User::class)->create([
            'name' => 'testUser',
            'email' => 'user@user.com'
        ]);
        $user->assignRole('User');

        factory(User::class, 15)->create();
    }
}
