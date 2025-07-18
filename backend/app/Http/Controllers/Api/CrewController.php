<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Crew;
use Illuminate\Http\Request;

class CrewController extends Controller
{
    public function index()
    {
        $crew = Crew::all();
        return response()->json($crew);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ship_id' => 'nullable|exists:ships,id',
            'first_name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'role' => 'required|in:Captain,Chief Officer,Able Seaman,Ordinary Seaman,Engine Cadet,Radio Officer,Chief Cook,Steward,Deckhand',
            'phone_number' => 'required|string|max:30|unique:crew,phone_number',
            'nationality' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);
        $crew = Crew::create($validated);
        return response()->json($crew, 201);
    }

    public function show(Crew $crew)
    {
        return response()->json($crew);
    }

    public function update(Request $request, Crew $crew)
    {
        $validated = $request->validate([
            'ship_id' => 'nullable|exists:ships,id',
            'first_name' => 'sometimes|required|string|max:150',
            'last_name' => 'sometimes|required|string|max:150',
            'role' => 'sometimes|required|in:Captain,Chief Officer,Able Seaman,Ordinary Seaman,Engine Cadet,Radio Officer,Chief Cook,Steward,Deckhand',
            'phone_number' => 'sometimes|required|string|max:30|unique:crew,phone_number,' . $crew->id,
            'nationality' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);
        $crew->update($validated);
        return response()->json($crew);
    }

    public function destroy(Crew $crew)
    {
        $crew->delete();
        return response()->json(['message' => 'Crew member deleted']);
    }
}
