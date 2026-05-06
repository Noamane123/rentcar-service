<div class="form-grid">
    <label>Marque<input name="marque" value="{{ old('marque', $car->marque ?? '') }}" required></label>
    <label>Modèle<input name="modele" value="{{ old('modele', $car->modele ?? '') }}" required></label>
    <label>Immatriculation<input name="immatriculation" value="{{ old('immatriculation', $car->immatriculation ?? '') }}" required></label>
    <label>Année<input type="number" name="annee" value="{{ old('annee', $car->annee ?? date('Y')) }}" required></label>
    <label>Prix / jour DH<input type="number" step="0.01" name="prix_jour" value="{{ old('prix_jour', $car->prix_jour ?? '') }}" required></label>
    <label>Statut
        <select name="statut" required>
            @foreach(['disponible' => 'Disponible', 'louee' => 'Louée', 'maintenance' => 'Maintenance'] as $value => $label)
                <option value="{{ $value }}" @selected(old('statut', $car->statut ?? 'disponible') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </label>
    <label class="full">Description<textarea name="description">{{ old('description', $car->description ?? '') }}</textarea></label>
</div>
<button class="btn primary" type="submit">Enregistrer</button>
<a class="btn ghost" href="{{ route('cars.index') }}">Annuler</a>
