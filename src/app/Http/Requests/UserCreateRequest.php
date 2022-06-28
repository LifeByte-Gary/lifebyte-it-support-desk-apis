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
            'location_office' => ['nullable', 'string'],
            'location_position' => ['nullable', 'string'],
            'state' => ['required', 'numeric'],
            'is_admin' => ['required', 'boolean'],
            'password' => ['required', 'alpha_num']
        ];
    }
}
