<?php

use Illuminate\Database\Seeder;
use App\Models\Frequency;

class FrequenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Frequency::truncate();

        $frequencies = [
            'Annual',
            'Tri-Annual',
            'Bi-Annual',
            'Quarterly',
            'Bi-Monthly',
            'Monthly',
            'Fortnightly',
            'Weekly',
            'Daily',
            'Irregular',
            '7 Per Annum',
            '8 Per Annum',
            '11 Per Annum',
            'Irregular'
        ];

        foreach ($frequencies as $frequncy) {
            factory(Frequency::class)->create([
                'name' => $frequncy
            ]);
        }
    }
}
