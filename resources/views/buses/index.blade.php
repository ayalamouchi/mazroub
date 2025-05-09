@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Bus</h1>
    <a href="{{ route('buses.create') }}" class="btn btn-primary">Ajouter un Bus</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Horaire de départ</th>
                <th>Horaire d'arrivée</th>
                <th>Distance</th>
                <th>Adresse</th>
                <th>Lieu</th>
                <th>Numéro de bus</th>
                <th>Station</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buses as $bus)
            <tr>
                <td>{{ $bus->horaire_dep }}</td>
                <td>{{ $bus->horaire_arr }}</td>
                <td>{{ $bus->distance }}</td>
                <td>{{ $bus->adress }}</td>
                <td>{{ $bus->lieu }}</td>
                <td>{{ $bus->numero_bus }}</td>
                <td>{{ $bus->station->lieu }}</td>
                <td>
                    <a href="{{ route('buses.edit', $bus->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('buses.destroy', $bus->id) }}" method="POST" style="display:inline-block;">
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
