<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;

class StationController extends Controller
{
    //afficher toutes les stations
    public function index()
    {
        $stations = Station::all();
        return view('stations.index', compact('stations'));
    }
    //afficher le formulaire de creation
    public function create()
    {
        return view('stations.create');
    }
    //enregistrer une nouvelle station
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lieu'         => 'required|string|max:255|unique:stations,lieu',
            'adress'       => 'required|string|max:255',
            'localisation' => 'nullable|string|max:255',
            'nombreBus'    => 'nullable|integer',
        ]);
        Station::create($validated);
        return redirect()->route('stations.index')->with('success', 'station ajoutée avec succès');
    }
    //afficher les details d'une station
    public function show(Station $station)
    {
        return view('stations.show', compact('station'));
    }
    //afficher le formulaire de update
    public function edit(Station $station)
    {
        return view('stations.edit', compact('station'));
    }
    //update station
    public function update(Request $request, Station $station)
    {
        $validated = $request->validate([
            'lieu'         => 'required|string|max:255|unique:stations,lieu,' . $station->id,
            'adress'       => 'required|string|max:255',
            'localisation' => 'nullable|string|max:255',
            'nombreBus'    => 'nullable|integer',
        ]);
        $station->update($validated);
        return redirect()->route('stations.index')->with('success', 'station modifiée avec succès');
    }
    //supprimer une station
    public function destroy(Station $station)
    {
        $station->delete();
        return redirect()->route('stations.index')->with('success', 'station supprimée avec succès');
    }
}
