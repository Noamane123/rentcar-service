@extends('layouts.app')
@section('title', 'Parc voitures')
@section('content')
<section class="panel">
    <div class="panel-header">
        <form class="search" method="GET"><input name="search" placeholder="Rechercher une voiture..." value="{{ request('search') }}"></form>
        @if(auth()->user()?->isAdmin())
            <a class="btn primary" href="{{ route('cars.create') }}">Ajouter une voiture</a>
        @else
            <span class="permission-note">Lecture seule: seul l'administrateur peut ajouter ou modifier les voitures.</span>
        @endif
    </div>
    <div class="vehicle-grid">
        @forelse($cars as $car)
            <article class="vehicle-card">
                <div class="vehicle-top"><span class="vehicle-icon">🚙</span><span class="badge {{ $car->statut }}">{{ $car->statut }}</span></div>
                <h3>{{ $car->marque }} {{ $car->modele }}</h3>
                <p>{{ $car->description }}</p>
                <div class="vehicle-meta"><span>{{ $car->immatriculation }}</span><span>{{ $car->annee }}</span><strong>{{ number_format($car->prix_jour, 2) }} DH/jour</strong></div>
                @if(auth()->user()?->isAdmin())
                    <div class="actions">
                        <a href="{{ route('cars.edit', $car) }}">Modifier</a>
                        <form method="POST" action="{{ route('cars.destroy', $car) }}" onsubmit="return confirm('Supprimer cette voiture ?')">
                            @csrf @method('DELETE')
                            <button>Supprimer</button>
                        </form>
                    </div>
                @endif
            </article>
        @empty
            <p>Aucune voiture trouvée.</p>
        @endforelse
    </div>
    {{ $cars->links() }}
</section>
@endsection
