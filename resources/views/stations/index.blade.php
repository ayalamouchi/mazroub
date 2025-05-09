@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Stations</h1>
    <a href="{{ route('stations.create') }}" class="btn btn-primary">Ajouter une Station</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Lieu</th>
                <th>Adresse</th>
                <th>Localisation</th>
                <th>Nombre de Bus</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stations as $station)
            <tr>
                <td>{{ $station->lieu }}</td>
                <td>{{ $station->adress }}</td>
                <td>{{ $station->localisation }}</td>
                <td>{{ $station->nombreBus }}</td>
                <td>
                    <a href="{{ route('stations.edit', $station->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('stations.destroy', $station->id) }}" method="POST" style="display:inline-block;">
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
