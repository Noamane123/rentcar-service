@extends('layouts.app')
@section('title', 'Utilisateurs & permissions')
@section('content')
<section class="panel">
    <div class="panel-header">
        <h2>Comptes utilisateurs</h2>
        <a class="btn primary" href="{{ route('users.create') }}">Ajouter un utilisateur</a>
    </div>
    <table>
        <thead><tr><th>Nom</th><th>Email</th><th>Rôle</th><th>Actions</th></tr></thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><strong>{{ $user->name }}</strong></td>
                <td>{{ $user->email }}</td>
                <td><span class="badge">{{ $user->role === 'admin' ? 'Administrateur' : 'Car manager' }}</span></td>
                <td class="actions">
                    <a href="{{ route('users.edit', $user) }}">Modifier</a>
                    <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                        @csrf @method('DELETE')
                        <button>Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</section>
@endsection
