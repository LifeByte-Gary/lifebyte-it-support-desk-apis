<?php

namespace App\Models;

use App\Models\Traits\HardwareTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    use HasFactory, HardwareTrait;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type',
        'brand',
        'model',
        'serial_number',
        'tag',
        'spec_os',
        'spec_cpu',
        'spec_memory',
        'spec_storage',
        'spec_screen_size',
        'spec_others',
        'bundle_with',
        'note',
    ];

    protected $casts = [
        'bundle_with' => 'array'
    ];
}
