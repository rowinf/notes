<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Note;
use App\Models\Tag;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $json = File::get("database/data.json");
        $data = json_decode($json);
        for ($i = 0; $i < 1; $i++) {
            foreach ($data->notes as $note_data) {
                $note = Note::create([
                    "content" => $note_data->content,
                    "title" => $note_data->title,
                    "last_edited_at" => $note_data->lastEdited,
                    "is_archived" => $note_data->isArchived,
                ]);
                foreach ($note_data->tags as $tagName) {
                    $tag = Tag::firstOrCreate([
                        "name" => $tagName,
                        "user_id" => null,
                    ]);
                    $note->tags()->syncWithoutDetaching($tag);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
