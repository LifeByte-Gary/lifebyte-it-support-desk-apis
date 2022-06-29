<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\LocationService;
use Illuminate\Database\Eloquent\Collection;

class LocationController extends Controller
{
    private LocationService $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index(): Collection
    {
        return $this->locationService->getAllLocations();
    }
}
