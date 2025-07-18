<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ship;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function index()
    {
        $ships = Ship::all();
        return response()->json($ships);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:200|unique:ships,registration_number',
            'capacity_in_tonnes' => 'nullable|numeric|min:0',
            'type' => 'required|in:cargo ship,passenger ship,military ship,icebreaker,fishing vessel,barge ship',
            'status' => 'required|in:active,under maintenance,decommissioned',
            'is_active' => 'boolean',
        ]);
        $ship = Ship::create($validated);
        return response()->json($ship, 201);
    }

    public function show(Ship $ship)
    {
        return response()->json($ship);
    }

    public function update(Request $request, Ship $ship)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'registration_number' => 'sometimes|required|string|max:200|unique:ships,registration_number,' . $ship->id,
            'capacity_in_tonnes' => 'nullable|numeric|min:0',
            'type' => 'sometimes|required|in:cargo ship,passenger ship,military ship,icebreaker,fishing vessel,barge ship',
            'status' => 'sometimes|required|in:active,under maintenance,decommissioned',
            'is_active' => 'boolean',
        ]);
        $ship->update($validated);
        return response()->json($ship);
    }

    public function destroy(Ship $ship)
    {
        $ship->delete();
        return response()->json(['message' => 'Ship deleted']);
    }
}
