<div class="form-grid">
    <label>Nom<input name="nom" value="{{ old('nom', $client->nom ?? '') }}" required></label>
    <label>Prénom<input name="prenom" value="{{ old('prenom', $client->prenom ?? '') }}" required></label>
    <label>Téléphone<input name="telephone" value="{{ old('telephone', $client->telephone ?? '') }}" required></label>
    <label>Email<input type="email" name="email" value="{{ old('email', $client->email ?? '') }}"></label>
    <label>CIN / Permis<input name="cin_permis" value="{{ old('cin_permis', $client->cin_permis ?? '') }}" required></label>
    <label>Adresse<input name="adresse" value="{{ old('adresse', $client->adresse ?? '') }}"></label>
</div>
<button class="btn primary" type="submit">Enregistrer</button>
<a class="btn ghost" href="{{ route('clients.index') }}">Annuler</a>
