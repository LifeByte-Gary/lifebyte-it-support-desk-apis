<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HardwareUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'user.id' => [Rule::exists('users', 'id')],
            'name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'type' => [Rule::in('Desktop', 'Laptop', 'Mouse', 'Keyboard', 'Adapter', 'Docking Station', 'TV', 'Others')],
            'brand' => ['nullable', 'string'],
            'serial_number' => ['nullable', 'string'],
            'tag' => ['nullable', 'string'],
            'spec_os' => ['nullable', 'string'],
            'spec_cpu' => ['nullable', 'string'],
            'spec_memory' => ['nullable', 'numeric'],
            'spec_screen_size' => ['nullable', 'numeric'],
            'spec_screen_ports' => ['nullable', 'array'],
            'spec_screen_ports.*' => ['string'],
            'spec_adapter_input' => ['nullable', 'string'],
            'spec_adapter_output' => ['nullable', 'array'],
            'spec_adapter_output.*' => ['string'],
            'spec_cable_length' => ['nullable', 'numeric'],
            'spec_others' => ['nullable', 'string'],
            'together' => ['nullable', 'array'],
            'together.*' => ['string'],
            'note' => ['nullable', 'string']
        ];
    }
}
