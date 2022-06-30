<?php

namespace App\Services;

use App\Http\Resources\HardwareResource;
use App\Repositories\HardwareRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HardwareService
{
    private HardwareRepository $hardwareRepository;

    public function __construct(HardwareRepository $hardwareRepository)
    {
        $this->hardwareRepository = $hardwareRepository;
    }

    public function getAllHardware(): ResourceCollection
    {
        return HardwareResource::collection($this->hardwareRepository->all());
    }
}
