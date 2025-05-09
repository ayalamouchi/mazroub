<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;

class EtudiantControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::with('user')->get();
        return response()->json($etudiants, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedUser = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validatedEtudiant = $request->validate([
            'institue' => 'required|string',
            'cin' => 'required|string|max:20',
            'localisation' => 'required|string',
        ]);

        $user = User::create([
            'nom' => $validatedUser['nom'],
            'prenom' => $validatedUser['prenom'],
            'email' => $validatedUser['email'],
            'password' => bcrypt($validatedUser['password']),
            'role' => 'USER',
        ]);

        $etudiant = Etudiant::create([
            'institue' => $validatedEtudiant['institue'],
            'cin' => $validatedEtudiant['cin'],
            'localisation' => $validatedEtudiant['localisation'],
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Étudiant créé avec succès',
            'data' => $etudiant->load('user')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $etudiant = Etudiant::with('user')->find($id);

        if (!$etudiant) {
            return response()->json(['error' => 'Étudiant non trouvé'], 404);
        }

        return response()->json($etudiant, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $etudiant = Etudiant::with('user')->find($id);
        if (!$etudiant) {
            return response()->json(['error' => 'Étudiant non trouvé'], 404);
        }

        $validatedUser = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $etudiant->user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $validatedEtudiant = $request->validate([
            'institue' => 'required|string',
            'cin' => 'required|string|max:20',
            'localisation' => 'required|string',
        ]);

        $etudiant->user->update([
            'nom' => $validatedUser['nom'],
            'prenom' => $validatedUser['prenom'],
            'email' => $validatedUser['email'],
            'password' => !empty($validatedUser['password']) ? bcrypt($validatedUser['password']) : $etudiant->user->password,
        ]);

        $etudiant->update($validatedEtudiant);

        return response()->json([
            'message' => 'Étudiant mis à jour avec succès',
            'data' => $etudiant->load('user')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etudiant = Etudiant::find($id);
        if (!$etudiant) {
            return response()->json(['error' => 'Étudiant non trouvé'], 404);
        }

        $etudiant->delete();

        return response()->json(['message' => 'Étudiant supprimé avec succès'], 200);
    }
}
