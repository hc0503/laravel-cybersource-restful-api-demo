<?php

use Illuminate\Database\Seeder;
use App\Models\Magazine;
use Illuminate\Filesystem\Filesystem;

class MagazinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Magazine::truncate();

        $FileSystem = new Filesystem();
        $directory = public_path('storage/magazines/covers');
        if ($FileSystem->exists($directory)) {
            $FileSystem->deleteDirectory($directory);
        }

        factory(Magazine::class, 3)->create();
    }
}
