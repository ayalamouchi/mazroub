<?php

namespace App\Http\Controllers;
use App\Models\Bus;
use App\Models\Station;
use Illuminate\Http\Request;

class BusController extends Controller
{
    //afficher tous les bus
    public function index()
    {
        $buses = Bus::with('station')->get();
        return view('buses.index', compact('buses'));
    }
    //afficher le formulaire de creation
    public function create()
    {
        $stations = Station::all();
        return view('buses.create', compact('stations'));
    }
    //enregister un nouveau bus
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
        Bus::create($validated);
        return redirect()->route('buses.index')->with('success', 'bus ajouté avec succès');
    }
    //afficher les details d'un bus
    public function show(Bus $bus)
    {
        return view('buses.show', compact('bus'));
    }
    //afficher le form de update
    public function edit(Bus $bus)
    {
        $stations = Station::all();
        return view('buses.edit', compact('bus', 'stations'));
    }
    //update bus
    public function update(Request $request, Bus $bus)
    {
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
        return redirect()->route('buses.index')->with('success', 'bus modifié avec succès');
    }
    //supprimer bus
    public function destroy(Bus $bus)
    {
        $bus->delete();
        return redirect()->route('buses.index')->with('success', 'bus supprimé avec succès');
    }

}
