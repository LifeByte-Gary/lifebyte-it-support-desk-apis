<?php

namespace App\Services;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

class LocationService
{
    public function getAllLocations(): Collection
    {
        return Location::all();
    }
}
