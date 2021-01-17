<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\GigItem;
use App\Models\Notification;
use App\Models\Profile;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        // create users
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
        ]);
    }
}
