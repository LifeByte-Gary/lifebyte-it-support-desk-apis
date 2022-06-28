<?php

namespace App\Models\Traits;

trait UserTrait
{
    public function isAdmin(): bool
    {
        return $this->getAttribute('is_admin') && $this->getAttribute('state');
    }
}
