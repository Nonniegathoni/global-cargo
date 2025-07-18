<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'email_address' => 'nullable|email|max:150|unique:clients,email_address',
            'phone_number' => 'nullable|string|max:50|unique:clients,phone_number',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        $client = Client::create($validated);
        return response()->json($client, 201);
    }

    public function show(Client $client)
    {
        return response()->json($client);
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|required|string|max:150',
            'last_name' => 'sometimes|required|string|max:150',
            'email_address' => 'nullable|email|max:150|unique:clients,email_address,' . $client->id,
            'phone_number' => 'nullable|string|max:50|unique:clients,phone_number,' . $client->id,
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        $client->update($validated);
        return response()->json($client);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(['message' => 'Client deleted']);
    }
}
