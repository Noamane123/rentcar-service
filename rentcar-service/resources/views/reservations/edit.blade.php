@extends('layouts.app')
@section('title', 'Modifier une réservation')
@section('content')
<section class="panel"><form method="POST" action="{{ route('reservations.update', $reservation) }}">@csrf @method('PUT') @include('reservations._form')</form></section>
@endsection
