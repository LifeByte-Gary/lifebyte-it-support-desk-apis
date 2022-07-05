<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\LocationResource;
use App\Repositories\LocationRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LocationController extends Controller
{
    private LocationRepository $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return LocationResource::collection($this->locationRepository->getAllLocations());
    }
}
