<?php

namespace App\Http\Controllers;
use App\Models\Etudiant;

use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    // Afficher tous les étudiants
    public function index()
    {
        $etudiants = Etudiant::all();
        return view('etudiants.index', compact('etudiants'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('etudiants.create');
    }

    // Enregistrer un nouvel étudiant
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

    // Création du user
    $user = \App\Models\User::create([
        'nom' => $validatedUser['nom'],
        'prenom' => $validatedUser['prenom'],
        'email' => $validatedUser['email'],
        'password' => bcrypt($validatedUser['password']),
        'role' => 'USER',
    ]);

    // Création de l’étudiant lié à ce user
    Etudiant::create([
        'institue' => $validatedEtudiant['institue'],
        'cin' => $validatedEtudiant['cin'],
        'localisation' => $validatedEtudiant['localisation'],
        'user_id' => $user->id,
    ]);

    return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès');
}


    // Afficher un étudiant
    public function show(Etudiant $etudiant)
    {
        return view('etudiants.show', compact('etudiant'));
    }

    // Formulaire de modification
    public function edit(Etudiant $etudiant)
    {
        return view('etudiants.edit', compact('etudiant'));
    }

    // update un étudiant
    public function update(Request $request, Etudiant $etudiant)
{
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

    // Mettre à jour l’utilisateur
    $etudiant->user->update([
        'nom' => $validatedUser['nom'],
        'prenom' => $validatedUser['prenom'],
        'email' => $validatedUser['email'],
        // On met à jour le mot de passe seulement si renseigné
        'password' => !empty($validatedUser['password']) ? bcrypt($validatedUser['password']) : $etudiant->user->password,
    ]);

    // Mettre à jour l’étudiant
    $etudiant->update($validatedEtudiant);

    return redirect()->route('etudiants.index')->with('success', 'Étudiant modifié avec succès');
}

    // Supprimer un étudiant
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès');
    }
}
