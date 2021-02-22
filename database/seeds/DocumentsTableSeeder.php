<?php

use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\User;
use Illuminate\Filesystem\Filesystem;

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

        $FileSystem = new Filesystem();
        $directory = public_path('storage/documents');
        if ($FileSystem->exists($directory)) {
            $FileSystem->deleteDirectory($directory);
        }

        factory(Document::class, 3)->create();
        $documents = Document::all();

        User::all()->each(function ($user) use ($documents) {
            $user->documents()->attach(
                $documents->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
