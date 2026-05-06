@extends('layouts.app')
@section('title', 'Modifier un client')
@section('content')
<section class="panel"><form method="POST" action="{{ route('clients.update', $client) }}">@csrf @method('PUT') @include('clients._form')</form></section>
@endsection
