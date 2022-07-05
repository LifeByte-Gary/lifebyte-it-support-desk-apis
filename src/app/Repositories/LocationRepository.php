<?php

namespace App\Repositories;

use App\Interfaces\LocationInterface;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository implements LocationInterface
{
    public function getAllLocations(): Collection
    {
        return Location::all();
    }
}
