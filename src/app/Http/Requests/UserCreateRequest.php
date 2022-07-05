<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', Rule::unique(User::class, 'email'), 'email'],
            'department' => ['nullable', 'string'],
            'job_title' => ['nullable', 'string'],
            'desk' => ['nullable', 'string'],
            'company' => ['required', 'string'],
            'location.id' => ['required', Rule::exists('locations', 'id')],
            'type' => ['required', Rule::in(['Employee', 'Storage', 'Meeting Room', 'Others'])],
            'state' => ['required', 'numeric', 'min:0', 'max:1'],
            'permission_level' => ['required', 'numeric', 'min:0', $this->user()->isSuperAdmin() ? 'max:2' : 'max:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'permission_level.max' => 'Only an IT manager can create a user with high permission level.'
        ];
    }
}
