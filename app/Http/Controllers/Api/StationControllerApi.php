<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;

class StationControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Station::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lieu'         => 'required|string|max:255|unique:stations,lieu',
            'adress'       => 'required|string|max:255',
            'localisation' => 'nullable|string|max:255',
            'nombreBus'    => 'nullable|integer',
        ]);

        $station = Station::create($validated);
        return response()->json($station, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $station = Station::find($id);
        if (!$station) {
            return response()->json(['error' => 'Station non trouvée'], 404);
        }
        return response()->json($station);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $station = Station::find($id);
        if (!$station) {
            return response()->json(['error' => 'Station non trouvée'], 404);
        }

        $validated = $request->validate([
            'lieu'         => 'required|string|max:255|unique:stations,lieu,' . $station->id,
            'adress'       => 'required|string|max:255',
            'localisation' => 'nullable|string|max:255',
            'nombreBus'    => 'nullable|integer',
        ]);

        $station->update($validated);
        return response()->json($station);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $station = Station::find($id);
        if (!$station) {
            return response()->json(['error' => 'Station non trouvée'], 404);
        }

        $station->delete();
        return response()->json(['message' => 'Station supprimée avec succès']);
    }
}
