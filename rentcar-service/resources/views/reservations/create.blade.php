@extends('layouts.app')
@section('title', 'Nouvelle réservation')
@section('content')
<section class="panel"><form method="POST" action="{{ route('reservations.store') }}">@csrf @include('reservations._form')</form></section>
@endsection
