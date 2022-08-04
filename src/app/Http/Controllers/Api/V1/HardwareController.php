<?php

namespace App\Http\Controllers\Api\V1;

use App\Exports\HardwareExport;
use App\Http\Requests\HardwareCreateRequest;
use App\Http\Requests\HardwareUpdateRequest;
use App\Http\Resources\HardwareResource;
use App\Imports\HardwareImport;
use App\Models\Hardware;
use App\Repositories\HardwareRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    public function store(HardwareCreateRequest $request)
    {
        $this->hardwareRepository->createHardware($request);

        return response(null, 204);
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
        $this->hardwareRepository->deleteHardware($hardware);
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new HardwareImport(), $request->file('file'));

            return response(null, 204);
        } catch (Exception) {
            return response('Failed to import', 500);
        }
    }

    public function export(): BinaryFileResponse
    {
        try {
            return Excel::download(new HardwareExport(), 'hardware.xlsx');
        } catch (Exception) {
            response('Failed to export', 500);
        }
    }
}
