<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\HardwareResource;
use App\Models\Hardware;
use App\Services\HardwareService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HardwareController extends Controller
{
    private HardwareService $hardwareService;

    public function __construct(HardwareService $hardwareService)
    {
        $this->hardwareService = $hardwareService;
    }

    public function index(Request $request): ResourceCollection
    {
        $query = $request->query();

        if (!count($query)) {
            return $this->hardwareService->getAllHardware();
        }

        return $this->hardwareService->filterHardware($query);
    }

    public function store(Request $request): void
    {
        //
    }

    public function show($id): HardwareResource
    {
        return $this->hardwareService->findAUserById($id);
    }


    public function update(Request $request, Hardware $hardware): void
    {
        //
    }

    public function destroy(Hardware $hardware): void
    {
        // TODO
    }
}
