<?php

namespace Database\Seeders;

use App\Models\Note;
use File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data.json");
        $data = json_decode($json);
        foreach ($data->notes as $note) {
            Note::create([
                "content"=> $note->content,
                "title"=> $note->title,
                "last_edited_at"=> $note->lastEdited,
                "is_archived"=> $note->isArchived,
            ]);
        }
    }
}
