<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\HardwareUpdateRequest;
use App\Http\Resources\HardwareResource;
use App\Models\Hardware;
use App\Repositories\HardwareRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HardwareController extends Controller
{
    private HardwareRepository $hardwareRepository;

    public function __construct(HardwareRepository $hardwareRepository)
    {
        $this->hardwareRepository = $hardwareRepository;
    }

    public function index(Request $request): ResourceCollection
    {
        $filter = $request->query();

        return HardwareResource::collection($this->hardwareRepository->findHardware($filter));
    }

    public function store(Request $request): void
    {
        // TODO
    }

    public function show(string $id): HardwareResource
    {
        return new HardwareResource($this->hardwareRepository->findAHardwareById($id));
    }


    public function update(HardwareUpdateRequest $request, Hardware $hardware)
    {
        $this->hardwareRepository->updateHardware($request, $hardware);

        return response(null, 204);
    }

    public function destroy(Hardware $hardware): void
    {
        // TODO
    }
}
