<div class="form-grid">
    <label>Nom complet<input name="name" value="{{ old('name', $user->name ?? '') }}" required></label>
    <label>Email<input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required></label>
    <label>Rôle
        <select name="role" required>
            <option value="admin" @selected(old('role', $user->role ?? '') === 'admin')>Administrateur - accès complet</option>
            <option value="car_manager" @selected(old('role', $user->role ?? 'car_manager') === 'car_manager')>Car manager - pas d'ajout voitures/utilisateurs</option>
        </select>
    </label>
    <label>Mot de passe<input type="password" name="password" {{ isset($user) ? '' : 'required' }}></label>
    <label>Confirmer mot de passe<input type="password" name="password_confirmation" {{ isset($user) ? '' : 'required' }}></label>
    @isset($user)<p class="permission-note full">Laissez le mot de passe vide pour garder l'ancien.</p>@endisset
</div>
<button class="btn primary" type="submit">Enregistrer</button>
<a class="btn ghost" href="{{ route('users.index') }}">Annuler</a>
