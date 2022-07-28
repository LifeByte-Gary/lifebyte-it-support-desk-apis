<?php

namespace App\Http\Requests;

use App\Models\Hardware;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HardwareCreateRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'user.id' => ['required', Rule::exists('users', 'id')],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'type' => ['required', Rule::in('Desktop', 'Laptop', 'Mouse', 'Keyboard', 'Adapter', 'Docking Station', 'Monitor', 'TV', 'Phone', 'Others')],
            'brand' => ['required', 'string'],
            'model' => ['nullable', 'string'],
            'ids' => ['required', 'array', 'min:1'],
            'ids.*.serial_number' => ['required', 'string', Rule::unique(Hardware::class, 'serial_number')],
            'ids.*.tag' => ['required', 'string', Rule::unique(Hardware::class, 'tag')],
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

    public function messages(): array
    {
        return [
            'ids.*.serial_number.unique' => ['The serial number of item :position has already been taken.'],
            'ids.*.tag.unique' => ['The tag of item :position has already been taken.'],
        ];
    }
}
