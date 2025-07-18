<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index()
    {
        $cargo = Cargo::all();
        return response()->json($cargo);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'weight' => 'required|numeric|min:0.01',
            'volume' => 'nullable|numeric|min:0',
            'client_id' => 'required|exists:clients,id',
            'cargo_type' => 'required|in:perishable,dangerous,general,other',
            'is_active' => 'boolean',
        ]);
        $cargo = Cargo::create($validated);
        return response()->json($cargo, 201);
    }

    public function show(Cargo $cargo)
    {
        return response()->json($cargo);
    }

    public function update(Request $request, Cargo $cargo)
    {
        $validated = $request->validate([
            'description' => 'sometimes|required|string',
            'weight' => 'sometimes|required|numeric|min:0.01',
            'volume' => 'nullable|numeric|min:0',
            'client_id' => 'sometimes|required|exists:clients,id',
            'cargo_type' => 'sometimes|required|in:perishable,dangerous,general,other',
            'is_active' => 'boolean',
        ]);
        $cargo->update($validated);
        return response()->json($cargo);
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->delete();
        return response()->json(['message' => 'Cargo deleted']);
    }
}
