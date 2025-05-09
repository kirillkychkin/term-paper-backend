<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TagCategory extends Model
{
    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }
}
