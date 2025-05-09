<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagCategory extends Model
{
    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }
}
