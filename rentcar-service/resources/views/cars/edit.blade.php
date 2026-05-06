@extends('layouts.app')
@section('title', 'Modifier une voiture')
@section('content')
<section class="panel"><form method="POST" action="{{ route('cars.update', $car) }}">@csrf @method('PUT') @include('cars._form')</form></section>
@endsection
