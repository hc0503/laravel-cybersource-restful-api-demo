<?php

use Illuminate\Database\Seeder;
use App\Models\Slider;
use Illuminate\Filesystem\Filesystem;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::truncate();

        $FileSystem = new Filesystem();
        $directory = public_path() . '/storage/sliders';
        if ($FileSystem->exists($directory)) {
            $files = $FileSystem->files($directory);
            $FileSystem->deleteDirectory($directory);
        }
        
        factory(Slider::class, 3)->create();
    }
}
