@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ajouter un Étudiant</h1>
        <form action="{{ route('etudiants.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="institue">Institut</label>
                <input type="text" class="form-control" id="institue" name="institue" required>
            </div>
            <div class="form-group">
                <label for="cin">CIN</label>
                <input type="text" class="form-control" id="cin" name="cin" required>
            </div>
            <div class="form-group">
                <label for="localisation">Localisation</label>
                <input type="text" class="form-control" id="localisation" name="localisation" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
