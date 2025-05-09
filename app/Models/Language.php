<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Language extends Model
{
    public function repositories(): BelongsToMany
    {
        return $this->belongsToMany(Repository::class);
    }
}
