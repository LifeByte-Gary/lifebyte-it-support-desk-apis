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
            'type' => [Rule::in('Desktop', 'Laptop', 'Mouse', 'Keyboard', 'Adapter', 'Docking Station', 'TV', 'Phone', 'Others')],
            'brand' => ['nullable', 'string'],
            'model' => ['nullable', 'string'],
            'serial_number' => ['nullable', 'string'],
            'tag' => ['nullable', 'string'],
            'spec_os' => ['nullable', 'string'],
            'spec_cpu' => ['nullable', 'string'],
            'spec_memory' => ['nullable', 'numeric'],
            'spec_storage' => ['nullable', 'numeric'],
            'spec_screen_size' => ['nullable', 'numeric'],
            'spec_others' => ['nullable', 'string'],
            'bundle_with' => ['nullable', 'array'],
            'bundle_with.*' => ['string'],
            'note' => ['nullable', 'string']
        ];
    }
}
