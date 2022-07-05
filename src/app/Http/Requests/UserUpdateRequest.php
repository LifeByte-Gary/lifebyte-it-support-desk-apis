<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property User $user
 */
class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => ['string'],
            'email' => ['email', Rule::unique('users')->ignore($this->user->id)],
            'department' => ['nullable', 'string'],
            'job_title' => ['nullable', 'string'],
            'desk' => ['nullable', 'string'],
            'company' => ['string'],
            'location.id' => [Rule::exists('locations', 'id')],
            'type' => [Rule::in(['Employee', 'Storage', 'Meeting Room', 'Others'])],
            'state' => ['numeric', 'min:0', 'max:1'],
            'permission_level' => ['numeric', 'min:0', $this->user()->isSuperAdmin() ? 'max:2' : 'max:0'],
        ];
    }
}
