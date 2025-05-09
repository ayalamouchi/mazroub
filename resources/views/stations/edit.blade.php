@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier une Station</h1>
    <form action="{{ route('stations.update', $station->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" name="lieu" id="lieu" class="form-control" value="{{ $station->lieu }}" required>
        </div>
        <div class="form-group">
            <label for="adress">Adresse</label>
            <input type="text" name="adress" id="adress" class="form-control" value="{{ $station->adress }}" required>
        </div>
        <div class="form-group">
            <label for="localisation">Localisation</label>
            <input type="text" name="localisation" id="localisation" class="form-control" value="{{ $station->localisation }}">
        </div>
        <div class="form-group">
            <label for="nombreBus">Nombre de Bus</label>
            <input type="number" name="nombreBus" id="nombreBus" class="form-control" value="{{ $station->nombreBus }}">
        </div>
        <button type="submit" class="btn btn-warning">Mettre à jour</button>
    </form>
</div>
@endsection
