<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Note;
use App\Models\Tag;
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
        $user = User::first();
        for ($i = 0; $i < 1; $i++) {
            foreach ($data->notes as $note_data) {
                $note = Note::create([
                    "content" => $note_data->content,
                    "title" => $note_data->title,
                    "last_edited_at" => $note_data->lastEdited,
                    "is_archived" => $note_data->isArchived,
                    "user_id" => $user->id,
                ]);
                foreach ($note_data->tags as $tagName) {
                    $tag = Tag::createOrFirst([
                        "name" => $tagName,
                        "user_id" => $user->id,
                    ]);
                    $note->tags()->save($tag);
                }
            }
        }
    }
}
