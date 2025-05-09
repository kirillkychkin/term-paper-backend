<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function repositories(): BelongsToMany
    {
        return $this->belongsToMany(Repository::class);
    }
}
