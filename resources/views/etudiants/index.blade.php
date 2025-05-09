@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des Étudiants</h1>
        <a href="{{ route('etudiants.create') }}" class="btn btn-primary">Ajouter un Étudiant</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Institut</th>
                    <th>CIN</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($etudiants as $etudiant)
                    <tr>
                        <td>{{ $etudiant->user->nom }}</td>
                        <td>{{ $etudiant->user->prenom }}</td>
                        <td>{{ $etudiant->user->email }}</td>
                        <td>{{ $etudiant->institue }}</td>
                        <td>{{ $etudiant->cin }}</td>
                        <td>
                            <a href="{{ route('etudiants.show', $etudiant->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
