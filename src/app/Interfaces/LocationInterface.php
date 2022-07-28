<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface LocationInterface
{
    public function getAllLocations(): Collection;

}
