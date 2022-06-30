<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HardwareResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
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
