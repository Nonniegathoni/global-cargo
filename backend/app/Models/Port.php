<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'port_type',
        'coordinates',
        'depth',
        'docking_capacity',
        'max_vessel_size',
        'security_level',
        'customs_authorized',
        'operational_hours',
        'port_manager',
        'port_contact_info',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'customs_authorized' => 'boolean',
        'depth' => 'float',
        'max_vessel_size' => 'float',
    ];

    public function shipmentsOrigin()
    {
        return $this->hasMany(Shipment::class, 'origin_port_id');
    }

    public function shipmentsDestination()
    {
        return $this->hasMany(Shipment::class, 'destination_port_id');
    }
}
