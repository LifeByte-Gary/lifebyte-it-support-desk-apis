<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $email
 * @property mixed $company
 * @property mixed $department
 * @property mixed $updated_at
 * @property mixed $created_at
 * @property mixed $permission_level
 * @property mixed $type
 * @property mixed $state
 * @property mixed $desk
 * @property mixed $job_title
 */
class UserResource extends JsonResource
{
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'company' => $this->company,
            'department' => $this->department,
            'job_title' => $this->job_title,
            'location' => new LocationResource($this->whenLoaded('location')),
            'hardware' => HardwareResource::collection($this->whenLoaded('hardware')),
            'desk' => $this->desk,
            'state' => $this->state,
            'type' => $this->type,
            'permission_level' => $this->permission_level,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
