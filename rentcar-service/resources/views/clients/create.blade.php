@extends('layouts.app')
@section('title', 'Ajouter un client')
@section('content')
<section class="panel"><form method="POST" action="{{ route('clients.store') }}">@csrf @include('clients._form')</form></section>
@endsection
