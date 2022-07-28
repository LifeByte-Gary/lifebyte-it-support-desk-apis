<?php

namespace App\Repositories;

use App\Http\Requests\HardwareCreateRequest;
use App\Http\Requests\HardwareUpdateRequest;
use App\Interfaces\HardwareInterface;
use App\Models\Hardware;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class HardwareRepository implements HardwareInterface
{
    public function findHardware(array $filter): Collection|array|LengthAwarePaginator
    {
        $name = $filter['name'] ?? null;
        $type = $filter['type'] ?? null;
        $brand = $filter['brand'] ?? null;
        $model = $filter['model'] ?? null;
        $serialNumber = $filter['serial_number'] ?? null;
        $tag = $filter['tag'] ?? null;
        $specOs = $filter['spec_os'] ?? null;
        $specCpu = $filter['spec_cpu'] ?? null;
        $specMemory = $filter['spec_memory'] ?? null;
        $specStorage = $filter['spec_storage'] ?? null;
        $specScreenSize = $filter['spec_screen_size'] ?? null;
        $paginate = !(isset($filter['paginate']) && $filter['paginate'] === 'false');

        $query = Hardware::with('user')
            ->when($name, function ($query, $name) {
                $query->where('name', 'like', "%$name%");
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($brand, function ($query, $brand) {
                $query->where('brand', 'like', "%$brand%");
            })
            ->when($model, function ($query, $model) {
                $query->where('model', 'like', "%$model%");
            })
            ->when($serialNumber, function ($query, $serialNumber) {
                $query->where('serial_number', 'like', "%$serialNumber%");
            })
            ->when($tag, function ($query, $tag) {
                $query->where('tag', 'like', "%$tag%");
            })
            ->when($specOs, function ($query, $specOs) {
                $query->where('spec_os', 'like', "%$specOs%");
            })
            ->when($specCpu, function ($query, $specCpu) {
                $query->where('spec_cpu', 'like', "%$specCpu%");
            })
            ->when($specMemory, function ($query, $specMemory) {
                $query->where('spec_memory', $specMemory);
            })
            ->when($specStorage, function ($query, $specStorage) {
                $query->where('spec_storage', $specStorage);
            })
            ->when($specScreenSize, function ($query, $specScreenSize) {
                $query->where('spec_screen_size', $specScreenSize);
            });

        return $paginate ? $query->paginate() : $query->get();
    }

    public function findAHardwareById(string $id): Model|Collection|Builder|array|null
    {
        return Hardware::findOrFail($id)->loadMissing('user');
    }

    public function updateHardware(HardwareUpdateRequest $request, Hardware $hardware): void
    {
        // Update basic information.
        $hardware->name = $request->input('name') ?? $hardware->name;
        $hardware->user_id = $request->input('user')['id'] ?? $hardware->user_id;
        $hardware->description = $request->has('description') ? $request->input('description') : $hardware->description;
        $hardware->type = $request->input('type') ?? $hardware->type;
        $hardware->brand = $request->input('brand') ?? $hardware->brand;
        $hardware->model = $request->input('model') ?? $hardware->model;
        $hardware->serial_number = $request->input('serial_number') ?? $hardware->serial_number;
        $hardware->tag = $request->input('tag') ?? $hardware->tag;
        $hardware->bundle_with = $request->has('bundle_with') ? $request->input('bundle_with') : $hardware->bundle_with;
        $hardware->note = $request->has('note') ? $request->input('note') : $hardware->note;
        $hardware->spec_others = $request->has('spec_others') ? $request->input('spec_others') : $hardware->note;

        // Update specifications by type.
        switch ($hardware->type) {
            case 'Desktop':
            case 'Laptop':
                $hardware->spec_os = $request->input('spec_os') ?: $hardware->spec_os;
                $hardware->spec_cpu = $request->input('spec_cpu') ?: $hardware->spec_cpu;
                $hardware->spec_memory = $request->input('spec_memory') ?: $hardware->spec_memory;
                $hardware->spec_storage = $request->input('spec_storage') ?: $hardware->spec_storage;
                $hardware->spec_screen_size = $request->input('spec_screen_size') ?: $hardware->spec_screen_size;
                break;

            case 'TV':
            case 'Monitor':
                $hardware->spec_os = null;
                $hardware->spec_cpu = null;
                $hardware->spec_memory = null;
                $hardware->spec_storage = null;
                $hardware->spec_screen_size = $request->input('spec_screen_size') ?: $hardware->spec_screen_size;
                break;

            case 'Keyboard':
            case 'Mouse':
            case 'Docking Station':
            case 'Adapter':
                $hardware->spec_os = null;
                $hardware->spec_cpu = null;
                $hardware->spec_memory = null;
                $hardware->spec_storage = null;
                $hardware->spec_screen_size = null;
                break;

            case 'Others':
            default:
                $hardware->spec_os = $request->has('spec_os') ? $request->input('spec_os') : $hardware->spec_os;
                $hardware->spec_cpu = $request->has('spec_cpu') ? $request->input('spec_cpu') : $hardware->spec_cpu;
                $hardware->spec_memory = $request->has('spec_memory') ? $request->input('spec_memory') : $hardware->spec_memory;
                $hardware->spec_storage = $request->input('spec_storage') ?: $hardware->spec_storage;
                $hardware->spec_screen_size = $request->has('spec_screen_size') ? $request->input('spec_screen_size') : $hardware->spec_screen_size;
                break;
        }

        $hardware->save();
    }

    public function createHardware(HardwareCreateRequest $request): void
    {
        $hardware = $request->all();

        foreach ($hardware['ids'] as $id) {
            Hardware::create([
                'name' => $hardware['name'],
                'user_id' => $hardware['user']['id'],
                'description' => $hardware['description'],
                'type' => $hardware['type'],
                'brand' => $hardware['brand'],
                'model' => $hardware['model'],
                'serial_number' => $id['serial_number'],
                'tag' => $id['tag'],
                'spec_os' => $hardware['spec_os'],
                'spec_cpu' => $hardware['spec_cpu'],
                'spec_memory' => $hardware['spec_memory'],
                'spec_storage' => $hardware['spec_storage'],
                'spec_screen_size' => $hardware['spec_screen_size'],
                'spec_others' => $hardware['spec_others'],
                'bundle_with' => $hardware['bundle_with'],
                'note' => $hardware['note'],
            ]);
        }
    }
}
