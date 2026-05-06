@extends('layouts.app')
@section('title', 'Ajouter un utilisateur')
@section('content')
<section class="panel"><form method="POST" action="{{ route('users.store') }}">@csrf @include('users._form')</form></section>
@endsection
