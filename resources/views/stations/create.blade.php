@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une Station</h1>
    <form action="{{ route('stations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" name="lieu" id="lieu" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="adress">Adresse</label>
            <input type="text" name="adress" id="adress" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="localisation">Localisation</label>
            <input type="text" name="localisation" id="localisation" class="form-control">
        </div>
        <div class="form-group">
            <label for="nombreBus">Nombre de Bus</label>
            <input type="number" name="nombreBus" id="nombreBus" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>
@endsection
