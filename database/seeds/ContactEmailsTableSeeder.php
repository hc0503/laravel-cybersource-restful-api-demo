<?php

use Illuminate\Database\Seeder;
use App\Models\ContactEmail;

class ContactEmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactEmail::truncate();
        
        factory(ContactEmail::class)->create([
            'name' => 'Steve',
            'email' => 'steve@magazineheavendirect.com'
        ]);

        factory(ContactEmail::class)->create([
            'name' => 'Bill',
            'email' => 'bill@magazineheavendirect.com'
        ]);
    }
}
