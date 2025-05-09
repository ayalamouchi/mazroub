<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reclamation;
use Illuminate\Http\Request;

class ReclamationControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Reclamation::latest()->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string|max:2048',
        ]);

        $reclamation = Reclamation::create($validated);
        return response()->json([
            'message' => 'Réclamation enregistrée avec succès',
            'data' => $reclamation
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reclamation = Reclamation::find($id);
        if (!$reclamation) {
            return response()->json(['error' => 'Réclamation non trouvée'], 404);
        }

        return response()->json($reclamation, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reclamation = Reclamation::find($id);
        if (!$reclamation) {
            return response()->json(['error' => 'Réclamation non trouvée'], 404);
        }

        $reclamation->delete();
        return response()->json(['message' => 'Réclamation supprimée avec succès'], 200);
    }
    
}
