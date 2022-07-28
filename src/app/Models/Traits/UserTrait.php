<?php

namespace App\Models\Traits;

use App\Models\Hardware;
use App\Models\Location;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserTrait
{
    public function isAdmin(): bool
    {
        return ($this->getAttribute('permission_level') === 1 || $this->getAttribute('permission_level') === 2) && $this->getAttribute('state');
    }

    public function isSuperAdmin(): bool
    {
        return $this->getAttribute('permission_level') === 2 && $this->getAttribute('state');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function hardware(): HasMany
    {
        return $this->hasMany(Hardware::class);
    }
}
