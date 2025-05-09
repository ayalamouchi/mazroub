<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Taxi;
use Illuminate\Http\Request;

class TaxiControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Taxi::with('user')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'martricule' => 'required|string|unique:taxis,martricule',
            'zonedetravaill' => 'required|string',
            'disponibilite' => 'boolean',
            'station' => 'required|integer',
            'user_id' => 'required|exists:users,id',
        ]);

        $taxi = Taxi::create($validated);
        return response()->json($taxi, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($martricule)
    {
        $taxi = Taxi::with('user')->find($martricule);
        if (!$taxi) {
            return response()->json(['error' => 'Taxi non trouvé'], 404);
        }

        return response()->json($taxi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $martricule)
    {
        $taxi = Taxi::find($martricule);
        if (!$taxi) {
            return response()->json(['error' => 'Taxi non trouvé'], 404);
        }

        $validated = $request->validate([
            'zonedetravaill' => 'required|string',
            'disponibilite' => 'boolean',
            'station' => 'required|integer',
            'user_id' => 'required|exists:users,id',
        ]);

        $taxi->update($validated);
        return response()->json($taxi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($martricule)
    {
        $taxi = Taxi::find($martricule);
        if (!$taxi) {
            return response()->json(['error' => 'Taxi non trouvé'], 404);
        }

        $taxi->delete();
        return response()->json(['message' => 'Taxi supprimé avec succès']);
    }
    
}
