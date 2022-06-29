<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait LocationTrait
{
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
}
}
