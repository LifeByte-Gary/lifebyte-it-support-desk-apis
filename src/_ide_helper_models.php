<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Hardware
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property string $brand
 * @property string $serial_number
 * @property string $tag
 * @property string|null $spec_os
 * @property string|null $spec_cpu
 * @property int|null $spec_memory
 * @property string|null $spec_screen_size
 * @property array|null $spec_ports
 * @property string|null $spec_adapter_input
 * @property array|null $spec_adapter_output
 * @property int|null $spec_cable_length
 * @property string|null $spec_others
 * @property array|null $together
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\HardwareFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereSpecAdapterInput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereSpecAdapterOutput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereSpecCableLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereSpecCpu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereSpecMemory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereSpecOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereSpecOthers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereSpecPorts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereSpecScreenSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereTogether($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hardware whereUserId($value)
 */
	class Hardware extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Location
 *
 * @property int $id
 * @property string $name
 * @property string $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereName($value)
 */
	class Location extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $company
 * @property string|null $department
 * @property string|null $job_title
 * @property int $location_id
 * @property string|null $desk
 * @property int $state
 * @property string $type
 * @property int $permission_level
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hardware[] $hardware
 * @property-read int|null $hardware_count
 * @property-read \App\Models\Location|null $location
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDesk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePermissionLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

