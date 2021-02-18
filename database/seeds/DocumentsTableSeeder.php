<?php

use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\User;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::truncate();
        DB::table('user_documents')->truncate();

        factory(Document::class, 12)->create();
        $documents = Document::all();

        User::all()->each(function ($user) use ($documents) {
            $user->documents()->attach(
                $documents->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
