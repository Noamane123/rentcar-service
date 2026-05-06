<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentCar Pro</title>
    <link rel="stylesheet" href="{{ asset('css/rentcar.css') }}">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <div class="brand">
            <span class="brand-icon">🚘</span>
            <div>
                <strong>RentCar Pro</strong>
                <small>Agence de location</small>
            </div>
        </div>
        <nav>
            <a href="{{ route('dashboard') }}">Tableau de bord</a>
            <a href="{{ route('cars.index') }}">Parc voitures</a>
            <a href="{{ route('clients.index') }}">Clients</a>
            <a href="{{ route('reservations.index') }}">Réservations</a>
            @if(auth()->user()?->isAdmin())
                <a href="{{ route('users.index') }}">Utilisateurs & permissions</a>
            @endif
        </nav>

        <div class="role-box">
            <span>Rôle connecté</span>
            <strong>{{ auth()->user()?->role === 'admin' ? 'Administrateur' : 'Car manager' }}</strong>
        </div>

        <form class="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    </aside>

    <main class="content">
        <header class="topbar hero-strip">
            <div>
                <p class="eyebrow">Gestion professionnelle de location</p>
                <h1>@yield('title', 'Tableau de bord')</h1>
                <p>Suivi du parc, clients, réservations et permissions utilisateurs.</p>
            </div>
            <div class="admin-chip">{{ auth()->user()->name ?? 'Utilisateur' }}</div>
        </header>

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert error">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>
