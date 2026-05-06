<div class="form-grid">
    <label>Voiture
        <select name="car_id" required>
            @foreach($cars as $car)
                <option value="{{ $car->id }}" @selected(old('car_id', $reservation->car_id ?? '') == $car->id)>{{ $car->marque }} {{ $car->modele }} - {{ $car->immatriculation }} / {{ $car->prix_jour }} DH</option>
            @endforeach
        </select>
    </label>
    <label>Client
        <select name="client_id" required>
            @foreach($clients as $client)
                <option value="{{ $client->id }}" @selected(old('client_id', $reservation->client_id ?? '') == $client->id)>{{ $client->prenom }} {{ $client->nom }}</option>
            @endforeach
        </select>
    </label>
    <label>Date début<input type="date" name="date_debut" value="{{ old('date_debut', isset($reservation) ? $reservation->date_debut->format('Y-m-d') : '') }}" required></label>
    <label>Date fin<input type="date" name="date_fin" value="{{ old('date_fin', isset($reservation) ? $reservation->date_fin->format('Y-m-d') : '') }}" required></label>
    <label>Statut
        <select name="statut" required>
            @foreach(['active' => 'Active', 'terminee' => 'Terminée', 'annulee' => 'Annulée'] as $value => $label)
                <option value="{{ $value }}" @selected(old('statut', $reservation->statut ?? 'active') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </label>
    <label class="full">Notes<textarea name="notes">{{ old('notes', $reservation->notes ?? '') }}</textarea></label>
</div>
<button class="btn primary" type="submit">Enregistrer</button>
<a class="btn ghost" href="{{ route('reservations.index') }}">Annuler</a>
