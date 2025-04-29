<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsStringable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

class Note extends Model
{
    /** @use HasFactory<\Database\Factories\NoteFactory> */
    use HasFactory;

    protected $fillable = [
        "title",
        "content",
        "last_edited_at",
        "is_archived",
    ];

    public function getTitleAttribute($value)
    {
        return $value ?? "";
    }

    public function getLastEditedAtAttribute($value)
    {
        if (!$value) {
            return "";
        }
        return Carbon::parse($value)->format('d M Y');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
