@extends('layouts.app')
@section('title', 'Clients')
@section('content')
<section class="panel">
    <div class="panel-header">
        <form class="search" method="GET"><input name="search" placeholder="Rechercher un client..." value="{{ request('search') }}"></form>
        <a class="btn primary" href="{{ route('clients.create') }}">Ajouter un client</a>
    </div>
    <table>
        <thead><tr><th>Client</th><th>Téléphone</th><th>Email</th><th>CIN / Permis</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($clients as $client)
            <tr>
                <td><strong>{{ $client->prenom }} {{ $client->nom }}</strong><br><small>{{ $client->adresse }}</small></td>
                <td>{{ $client->telephone }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->cin_permis }}</td>
                <td class="actions">
                    <a href="{{ route('clients.edit', $client) }}">Modifier</a>
                    <form method="POST" action="{{ route('clients.destroy', $client) }}" onsubmit="return confirm('Supprimer ce client ?')">
                        @csrf @method('DELETE')
                        <button>Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Aucun client trouvé.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $clients->links() }}
</section>
@endsection
