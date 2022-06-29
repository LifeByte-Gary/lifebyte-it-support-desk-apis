<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'department' => ['nullable', 'string'],
            'job_title' => ['nullable', 'string'],
            'desk' => ['nullable', 'string'],
            'company' => ['string'],
            'location.id' => ['required', Rule::exists('locations', 'id')],
            'type' => ['required', Rule::in(['Employee', 'Storage', 'Meeting Room', 'Others'])],
            'state' => ['required', 'numeric', 'min:0', 'max:1'],
            'permission_level' => ['required', 'numeric', 'min:0', 'max:2'],
        ];
    }
}
