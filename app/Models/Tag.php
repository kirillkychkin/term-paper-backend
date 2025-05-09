<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
