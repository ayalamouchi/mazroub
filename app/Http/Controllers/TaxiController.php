<?php

namespace App\Http\Controllers;
use App\Models\Taxi;
use App\Models\User;

use Illuminate\Http\Request;

class TaxiController extends Controller
{
     // Liste des taxis
     public function index()
     {
         $taxis = Taxi::all();
         return view('taxis.index', compact('taxis'));
     }

     
     // Formulaire de création
     public function create()
     {
         $users = User::all(); // Pour sélection dans un <select>
         return view('taxis.create', compact('users'));
     }

     // Enregistrement
     public function store(Request $request)
     {
         $validated = $request->validate([
             'martricule' => 'required|string|unique:taxis,martricule',
             'zonedetravaill' => 'required|string',
             'disponibilite' => 'boolean',
             'station' => 'required|integer',
             'user_id' => 'required|exists:users,id',
         ]);

         Taxi::create($validated);

         return redirect()->route('taxis.index')->with('success', 'Taxi ajouté avec succès.');
     }

     // Détails d'un taxi
     public function show($martricule)
     {
         $taxi = Taxi::findOrFail($martricule);
         return view('taxis.show', compact('taxi'));
     }

     // Formulaire d'édition
     public function edit($martricule)
     {
         $taxi = Taxi::findOrFail($martricule);
         $users = User::all();
         return view('taxis.edit', compact('taxi', 'users'));
     }

     // Mise à jour
     public function update(Request $request, $martricule)
     {
         $taxi = Taxi::findOrFail($martricule);

         $validated = $request->validate([
             'zonedetravaill' => 'required|string',
             'disponibilite' => 'boolean',
             'station' => 'required|integer',
             'user_id' => 'required|exists:users,id',
         ]);

         $taxi->update($validated);

         return redirect()->route('taxis.index')->with('success', 'Taxi mis à jour avec succès.');
     }

     // Suppression
     public function destroy($martricule)
     {
         $taxi = Taxi::findOrFail($martricule);
         $taxi->delete();

         return redirect()->route('taxis.index')->with('success', 'Taxi supprimé avec succès.');
     }
}
