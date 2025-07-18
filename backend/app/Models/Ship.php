<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_number',
        'capacity_in_tonnes',
        'type',
        'status',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'capacity_in_tonnes' => 'float',
    ];

    public function crew()
    {
        return $this->hasMany(Crew::class);
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}
