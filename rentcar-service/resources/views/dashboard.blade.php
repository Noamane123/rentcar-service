@extends('layouts.app')

@section('content')
<section class="hero">
    <h1>Gestion de location de voitures</h1>
    <p>Suivez vos voitures, clients et reservations depuis une interface simple en francais.</p>
</section>

<div class="cards">
    <div class="card"><span>Total voitures</span><strong>{{ $carsCount }}</strong></div>
    <div class="card"><span>Voitures disponibles</span><strong>{{ $availableCars }}</strong></div>
    <div class="card"><span>Clients</span><strong>{{ $clientsCount }}</strong></div>
    <div class="card"><span>Reservations</span><strong>{{ $reservationsCount }}</strong></div>
</div>
@endsection
