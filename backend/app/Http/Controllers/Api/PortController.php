<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    public function index()
    {
        $ports = Port::all();
        return response()->json($ports);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ports,name,NULL,id,country,' . $request->country,
            'country' => 'required|string|max:100',
            'port_type' => 'nullable|string|max:100',
            'coordinates' => 'nullable|string|max:50',
            'depth' => 'nullable|numeric',
            'docking_capacity' => 'nullable|integer',
            'max_vessel_size' => 'nullable|numeric',
            'security_level' => 'nullable|string|max:50',
            'customs_authorized' => 'nullable|boolean',
            'operational_hours' => 'nullable|string|max:50',
            'port_manager' => 'nullable|string|max:255',
            'port_contact_info' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);
        $port = Port::create($validated);
        return response()->json($port, 201);
    }

    public function show(Port $port)
    {
        return response()->json($port);
    }

    public function update(Request $request, Port $port)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:ports,name,' . $port->id . ',id,country,' . ($request->country ?? $port->country),
            'country' => 'sometimes|required|string|max:100',
            'port_type' => 'nullable|string|max:100',
            'coordinates' => 'nullable|string|max:50',
            'depth' => 'nullable|numeric',
            'docking_capacity' => 'nullable|integer',
            'max_vessel_size' => 'nullable|numeric',
            'security_level' => 'nullable|string|max:50',
            'customs_authorized' => 'nullable|boolean',
            'operational_hours' => 'nullable|string|max:50',
            'port_manager' => 'nullable|string|max:255',
            'port_contact_info' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);
        $port->update($validated);
        return response()->json($port);
    }

    public function destroy(Port $port)
    {
        $port->delete();
        return response()->json(['message' => 'Port deleted']);
    }
}
