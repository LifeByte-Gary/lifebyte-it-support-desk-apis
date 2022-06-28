<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'location_office' => ['nullable', 'string'],
            'location_position' => ['nullable', 'string'],
            'state' => ['required', 'numeric'],
            'is_admin' => ['required', 'boolean'],
        ];
    }
}
