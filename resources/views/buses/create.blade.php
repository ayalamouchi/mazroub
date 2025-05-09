@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un Bus</h1>
    <form action="{{ route('buses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="horaire_dep">Horaire de départ</label>
            <input type="text" name="horaire_dep" id="horaire_dep" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="horaire_arr">Horaire d'arrivée</label>
            <input type="text" name="horaire_arr" id="horaire_arr" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="distance">Distance</label>
            <input type="number" name="distance" id="distance" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="adress">Adresse</label>
            <input type="text" name="adress" id="adress" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" name="lieu" id="lieu" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="numero_bus">Numéro de Bus</label>
            <input type="text" name="numero_bus" id="numero_bus" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="station_id">Station</label>
            <select name="station_id" id="station_id" class="form-control" required>
                @foreach($stations as $station)
                    <option value="{{ $station->id }}">{{ $station->lieu }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>
@endsection
