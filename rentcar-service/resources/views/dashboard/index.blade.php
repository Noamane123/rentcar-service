@extends('layouts.app')
@section('title', 'Tableau de bord')
@section('content')
<section class="fleet-hero">
    <div>
        <p class="eyebrow">Vue agence</p>
        <h2>Votre parc automobile en temps réel</h2>
        <p>Clients récents, réservations actives et disponibilité des voitures.</p>
    </div>
    <div class="car-silhouette">🚗</div>
</section>

<section class="cards-grid">
    <div class="metric-card"><span>Total voitures</span><strong>{{ $totalCars }}</strong></div>
    <div class="metric-card"><span>Voitures disponibles</span><strong>{{ $availableCars }}</strong></div>
    <div class="metric-card"><span>Clients</span><strong>{{ $totalClients }}</strong></div>
    <div class="metric-card"><span>Réservations actives</span><strong>{{ $activeReservations }}</strong></div>
</section>

<section class="two-columns">
    <div class="panel">
        <div class="panel-header">
            <h2>Derniers clients</h2>
            <a class="btn" href="{{ route('clients.index') }}">Voir clients</a>
        </div>
        <table>
            <thead><tr><th>Client</th><th>Téléphone</th><th>Permis/CIN</th></tr></thead>
            <tbody>
            @forelse($latestClients as $client)
                <tr>
                    <td><strong>{{ $client->prenom }} {{ $client->nom }}</strong><br><small>{{ $client->email }}</small></td>
                    <td>{{ $client->telephone }}</td>
                    <td>{{ $client->cin_permis }}</td>
                </tr>
            @empty
                <tr><td colspan="3">Aucun client pour le moment.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h2>Dernières réservations</h2>
            <a class="btn" href="{{ route('reservations.create') }}">Nouvelle réservation</a>
        </div>
        <table>
            <thead><tr><th>Client</th><th>Voiture</th><th>Total</th><th>Statut</th></tr></thead>
            <tbody>
            @forelse($latestReservations as $reservation)
                <tr>
                    <td>{{ $reservation->client->prenom }} {{ $reservation->client->nom }}</td>
                    <td>{{ $reservation->car->marque }} {{ $reservation->car->modele }}</td>
                    <td>{{ number_format($reservation->prix_total, 2) }} DH</td>
                    <td><span class="badge {{ $reservation->statut }}">{{ $reservation->statut }}</span></td>
                </tr>
            @empty
                <tr><td colspan="4">Aucune réservation pour le moment.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
