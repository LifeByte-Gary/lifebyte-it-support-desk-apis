<?php

namespace App\Http\Controllers\Api\V1;

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

        return $this->hardwareService->getAllHardware();
    }

    public function store(Request $request): void
    {
        //
    }

    public function show(Hardware $hardware): void
    {
        //
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
