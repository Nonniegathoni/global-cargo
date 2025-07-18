<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::all();
        return response()->json($shipments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cargo_id' => 'required|exists:cargo,id',
            'ship_id' => 'required|exists:ships,id',
            'origin_port_id' => 'required|exists:ports,id',
            'destination_port_id' => 'required|exists:ports,id|different:origin_port_id',
            'departure_date' => 'required|date',
            'arrival_estimate' => 'required|date|after_or_equal:departure_date',
            'actual_arrival_date' => 'nullable|date|after_or_equal:departure_date',
            'status' => 'required|in:pending,in_transit,delivered,delayed',
            'is_active' => 'boolean',
        ]);
        $shipment = Shipment::create($validated);
        return response()->json($shipment, 201);
    }

    public function show(Shipment $shipment)
    {
        return response()->json($shipment);
    }

    public function update(Request $request, Shipment $shipment)
    {
        $validated = $request->validate([
            'cargo_id' => 'sometimes|required|exists:cargo,id',
            'ship_id' => 'sometimes|required|exists:ships,id',
            'origin_port_id' => 'sometimes|required|exists:ports,id',
            'destination_port_id' => 'sometimes|required|exists:ports,id|different:origin_port_id',
            'departure_date' => 'sometimes|required|date',
            'arrival_estimate' => 'sometimes|required|date|after_or_equal:departure_date',
            'actual_arrival_date' => 'nullable|date|after_or_equal:departure_date',
            'status' => 'sometimes|required|in:pending,in_transit,delivered,delayed',
            'is_active' => 'boolean',
        ]);
        $shipment->update($validated);
        return response()->json($shipment);
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return response()->json(['message' => 'Shipment deleted']);
    }
}
