<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 * @property string $note
 * @property array $together
 * @property string $spec_others
 * @property double $spec_cable_length
 * @property array $spec_adapter_output
 * @property string $spec_adapter_input
 * @property array $spec_ports
 * @property double $spec_screen_size
 * @property int $spec_memory
 * @property string $spec_cpu
 * @property string $spec_os
 * @property string $tag
 * @property string $serial_number
 * @property string $brand
 * @property string $type
 * @property string $description
 * @property User $user
 */
class HardwareResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user', function () {
                return $this->user->loadMissing('location');
            })),
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'brand' => $this->brand,
            'serial_number' => $this->serial_number,
            'tag' => $this->tag,
            'spec_os' => $this->spec_os,
            'spec_cpu' => $this->spec_cpu,
            'spec_memory' => $this->spec_memory,
            'spec_screen_size' => $this->spec_screen_size,
            'spec_ports' => $this->spec_ports,
            'spec_adapter_input' => $this->spec_adapter_input,
            'spec_adapter_output' => $this->spec_adapter_output,
            'spec_cable_length' => $this->spec_cable_length,
            'spec_others' => $this->spec_others,
            'together' => $this->together,
            'note' => $this->note
        ];
    }
}
