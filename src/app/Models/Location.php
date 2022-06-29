<?php

namespace App\Models;

use App\Models\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use LocationTrait;

    protected $fillable = [
        'name',
        'company',
        'country'
    ];

    public $timestamps = false;
}
