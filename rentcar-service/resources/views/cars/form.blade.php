<form class="form" method="POST" action="{{ $action }}">
@csrf
@if($method === 'PUT') @method('PUT') @endif
<label>Marque<input name="brand" value="{{ old('brand', $car->brand ?? '') }}" required></label>
<label>Modele<input name="model" value="{{ old('model', $car->model ?? '') }}" required></label>
<label>Matricule<input name="registration_number" value="{{ old('registration_number', $car->registration_number ?? '') }}" required></label>
<label>Annee<input type="number" name="year" value="{{ old('year', $car->year ?? '') }}"></label>
<label>Prix par jour<input type="number" step="0.01" name="daily_price" value="{{ old('daily_price', $car->daily_price ?? '') }}" required></label>
<label>Statut<select name="status"><option>Disponible</option><option>Louee</option><option>Maintenance</option></select></label>
<button class="btn">Enregistrer</button>
</form>
@if($errors->any())<div class="errors">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
