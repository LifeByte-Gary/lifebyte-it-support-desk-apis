<?php

namespace App\Models\Traits;

trait UserTrait
{
    public function isAdmin(): bool
    {
        return $this->getAttribute('permission_level') > 0 && $this->getAttribute('state');
    }
}
