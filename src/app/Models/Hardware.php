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
        'serial_number',
        'tag',
        'spec_os',
        'spec_cpu',
        'spec_memory',
        'spec_screen_size',
        'spec_ports',
        'spec_adapter_input',
        'spec_adapter_output',
        'spec_cable_length',
        'spec_others',
        'together',
        'note',
    ];

    protected $casts = [
        'spec_ports' => 'array',
        'spec_adapter_output' => 'array',
        'together' => 'array'
    ];
}
