@extends('layouts.app')
@section('title', 'Modifier un utilisateur')
@section('content')
<section class="panel"><form method="POST" action="{{ route('users.update', $user) }}">@csrf @method('PUT') @include('users._form')</form></section>
@endsection
