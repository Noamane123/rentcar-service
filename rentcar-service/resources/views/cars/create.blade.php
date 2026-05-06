@extends('layouts.app')
@section('title', 'Ajouter une voiture')
@section('content')
<section class="panel"><form method="POST" action="{{ route('cars.store') }}">@csrf @include('cars._form')</form></section>
@endsection
