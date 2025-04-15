<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = ['name'];
    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class)->orderByDesc('last_edited_at');
    }

    public function __tostring() {
        return $this->name;
    }
}
