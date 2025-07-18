<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'weight',
        'volume',
        'client_id',
        'cargo_type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'weight' => 'float',
        'volume' => 'float',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}
