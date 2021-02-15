<?php

use Illuminate\Database\Seeder;
use App\Models\Magazine;

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

        factory(Magazine::class, 13)->create();
    }
}
