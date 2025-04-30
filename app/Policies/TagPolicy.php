<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;

class TagPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Tag $tag): bool
    {
        return !($user || $tag->user_id) || $user->id === $tag->user_id;
    }
}
