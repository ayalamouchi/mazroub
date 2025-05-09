<?php

namespace App\Http\Controllers;
use App\Models\Reclamation;

use Illuminate\Http\Request;

class ReclamationController extends Controller
{
    public function index()
    {
        $reclamations = Reclamation::latest()->get();
        return view('reclamations.index', compact('reclamations'));
    }

    public function create()
    {
        return view('reclamations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string|max:2048',
        ]);

        Reclamation::create($request->all());

        return redirect()->route('reclamations.index')->with('success', 'Réclamation envoyée avec succès.');
    }

    public function show(Reclamation $reclamation)
    {
        return view('reclamations.show', compact('reclamation'));
    }
}
