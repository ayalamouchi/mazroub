<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bus;

class BusControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Bus::with('station')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'horaire_dep' => 'required|string',
            'horaire_arr' => 'required|string',
            'distance' => 'required|numeric',
            'adress' => 'required|string',
            'lieu' => 'required|string',
            'numero_bus' => 'required|string|unique:buses,numero_bus',
            'station_id' => 'required|exists:stations,id',
        ]);

        $bus = Bus::create($validated);
        return response()->json($bus, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bus = Bus::with('station')->find($id);
        if (!$bus) {
            return response()->json(['error' => 'Bus non trouvé'], 404);
        }
        return response()->json($bus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bus = Bus::find($id);
        if (!$bus) {
            return response()->json(['error' => 'Bus non trouvé'], 404);
        }

        $validated = $request->validate([
            'horaire_dep' => 'required|string',
            'horaire_arr' => 'required|string',
            'distance' => 'required|numeric',
            'adress' => 'required|string',
            'lieu' => 'required|string',
            'numero_bus' => 'required|string|unique:buses,numero_bus,' . $bus->id,
            'station_id' => 'required|exists:stations,id',
        ]);

        $bus->update($validated);
        return response()->json($bus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bus = Bus::find($id);
        if (!$bus) {
            return response()->json(['error' => 'Bus non trouvé'], 404);
        }

        $bus->delete();
        return response()->json(['message' => 'Bus supprimé avec succès']);
    }
}
