@extends('layouts.app')
@section('title', 'Réservations')
@section('content')
<section class="panel">
    <div class="panel-header">
        <h2>Liste des réservations</h2>
        <a class="btn primary" href="{{ route('reservations.create') }}">Nouvelle réservation</a>
    </div>
    <table>
        <thead><tr><th>Client</th><th>Voiture</th><th>Période</th><th>Total</th><th>Statut</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($reservations as $reservation)
            <tr>
                <td>{{ $reservation->client->prenom }} {{ $reservation->client->nom }}</td>
                <td>{{ $reservation->car->marque }} {{ $reservation->car->modele }}</td>
                <td>{{ $reservation->date_debut->format('d/m/Y') }} - {{ $reservation->date_fin->format('d/m/Y') }}</td>
                <td>{{ number_format($reservation->prix_total, 2) }} DH</td>
                <td><span class="badge {{ $reservation->statut }}">{{ $reservation->statut }}</span></td>
                <td class="actions">
                    <a href="{{ route('reservations.edit', $reservation) }}">Modifier</a>
                    <form method="POST" action="{{ route('reservations.destroy', $reservation) }}" onsubmit="return confirm('Supprimer cette réservation ?')">
                        @csrf @method('DELETE')
                        <button>Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Aucune réservation trouvée.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $reservations->links() }}
</section>
@endsection
