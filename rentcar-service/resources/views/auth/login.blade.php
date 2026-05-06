<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion admin - RentCar Pro</title>
    <link rel="stylesheet" href="{{ asset('css/rentcar.css') }}">
</head>
<body class="login-body">
    <main class="login-page">
        <section class="login-card">
            <div class="login-brand">
                <span class="brand-icon">RC</span>
                <div>
                    <strong>RentCar Pro</strong>
                    <small>Espace administrateur</small>
                </div>
            </div>

            <h1>Connexion</h1>
            <p>Connectez-vous pour gérer les voitures, clients et réservations.</p>

            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="login-form">
                @csrf
                <label>Email administrateur
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@rentcar.local" required autofocus>
                </label>

                <label>Mot de passe
                    <input type="password" name="password" placeholder="Votre mot de passe" required>
                </label>

                <label class="remember-line">
                    <input type="checkbox" name="remember" value="1">
                    Se souvenir de moi
                </label>

                <button class="btn primary full-btn" type="submit">Se connecter</button>
            </form>

            <div class="login-help">
                Compte de test: <strong>admin@rentcar.local</strong> / <strong>admin123</strong>
            </div>
        </section>
    </main>
</body>
</html>
