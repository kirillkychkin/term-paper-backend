<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function tagCategory(): BelongsTo
    {
        return $this->belongsTo(TagCategory::class);
    }

    public function repositories(): BelongsToMany
    {
        return $this->belongsToMany(Repository::class);
    }
}
