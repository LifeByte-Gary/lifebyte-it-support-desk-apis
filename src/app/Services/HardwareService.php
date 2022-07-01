<?php

namespace App\Services;

use App\Http\Requests\HardwareUpdateRequest;
use App\Http\Resources\HardwareResource;
use App\Models\Hardware;
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

    public function filterHardware(array $filter): ResourceCollection
    {
        return HardwareResource::collection($this->hardwareRepository->filter($filter));
    }

    public function findAUserById($id): HardwareResource
    {
        return new HardwareResource(Hardware::findOrFail($id));
    }

    public function updateAHardware(HardwareUpdateRequest $request, Hardware $hardware): void
    {
        // Update basic information.
        $hardware->name = $request->input('name') ?: $hardware->name;
        $hardware->description = $request->input('description') ?: $hardware->description;
        $hardware->type = $request->input('type') ?: $hardware->type;
        $hardware->brand = $request->input('brand') ?: $hardware->brand;
        $hardware->serial_number = $request->input('serial_number') ?: $hardware->serial_number;
        $hardware->tag = $request->input('tag') ?: $hardware->tag;
        $hardware->user_id = $request->input('user')['id'] ?: $hardware->user_id;
        $hardware->together = $request->has('together') ? $request->input('together') : $hardware->together;
        $hardware->note = $request->has('note') ? $request->input('note') : $hardware->note;
        $hardware->spec_others = $request->has('spec_others') ? $request->input('spec_others') : $hardware->note;

        // Update specifications by type.
        switch ($hardware->type) {
            case 'Desktop':
            case 'Laptop':
                $hardware->spec_os = $request->input('spec_os') ?: $hardware->spec_os;
                $hardware->spec_cpu = $request->input('spec_cpu') ?: $hardware->spec_cpu;
                $hardware->spec_memory = $request->input('spec_memory') ?: $hardware->spec_memory;
                $hardware->spec_screen_size = $request->input('spec_screen_size') ?: $hardware->spec_screen_size;
                $hardware->spec_ports = $request->has('spec_ports') ? $request->input('spec_ports') : $hardware->spec_ports;
                $hardware->spec_adapter_input = null;
                $hardware->spec_adapter_output = null;
                $hardware->spec_cable_length = null;
                break;

            case 'TV':
                $hardware->spec_os = null;
                $hardware->spec_cpu = null;
                $hardware->spec_memory = null;
                $hardware->spec_screen_size = $request->input('spec_screen_size') ?: $hardware->spec_screen_size;
                $hardware->spec_ports = $request->input('spec_ports') ?: $hardware->spec_ports;
                $hardware->spec_adapter_input = null;
                $hardware->spec_adapter_output = null;
                $hardware->spec_cable_length = null;
                break;

            case 'Keyboard':
            case 'Mouse':
                $hardware->spec_os = null;
                $hardware->spec_cpu = null;
                $hardware->spec_memory = null;
                $hardware->spec_screen_size = null;
                $hardware->spec_ports = null;
                $hardware->spec_adapter_input = null;
                $hardware->spec_adapter_output = null;
                $hardware->spec_cable_length = $request->input('spec_cable_length') ?: $hardware->spec_cable_length;
                break;

            case 'Docking Station':
                $hardware->spec_os = null;
                $hardware->spec_cpu = null;
                $hardware->spec_memory = null;
                $hardware->spec_screen_size = null;
                $hardware->spec_ports = $request->input('spec_ports') ?: $hardware->spec_ports;
                $hardware->spec_adapter_input = null;
                $hardware->spec_adapter_output = null;
                $hardware->spec_cable_length = null;
                break;

            case 'Adapter':
                $hardware->spec_os = null;
                $hardware->spec_cpu = null;
                $hardware->spec_memory = null;
                $hardware->spec_screen_size = null;
                $hardware->spec_ports = null;
                $hardware->spec_adapter_input = $request->input('spec_adapter_input') ?: $hardware->spec_adapter_input;
                $hardware->spec_adapter_output = $request->input('spec_adapter_output') ?: $hardware->spec_adapter_output;
                $hardware->spec_cable_length = $request->input('spec_cable_length') ?: $hardware->spec_cable_length;
                break;

            case 'Others':
            default:
                $hardware->spec_os = $request->input('spec_os') ?: $hardware->spec_os;
                $hardware->spec_cpu = $request->input('spec_cpu') ?: $hardware->spec_cpu;
                $hardware->spec_memory = $request->input('spec_memory') ?: $hardware->spec_memory;
                $hardware->spec_screen_size = $request->input('spec_screen_size') ?: $hardware->spec_screen_size;
                $hardware->spec_ports = $request->input('spec_ports') ?: $hardware->spec_ports;
                $hardware->spec_adapter_input = $request->input('spec_adapter_input') ?: $hardware->spec_adapter_input;
                $hardware->spec_adapter_output = $request->input('spec_adapter_output') ?: $hardware->spec_adapter_output;
                $hardware->spec_cable_length = $request->input('spec_cable_length') ?: $hardware->spec_cable_length;
                break;
        }

        $hardware->save();
    }
}
