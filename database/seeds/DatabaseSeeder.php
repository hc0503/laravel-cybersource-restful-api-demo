<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Artisan::call('passport:install');
        Schema::disableForeignKeyConstraints();
        
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(FrequenciesTableSeeder::class);
        $this->call(MagazinesTableSeeder::class);
        $this->call(DocumentsTableSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
