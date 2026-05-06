<form class="form" method="POST" action="{{ $action }}">
@csrf
@if($method === 'PUT') @method('PUT') @endif
<label>Voiture<select name="car_id" required>@foreach($cars as $car)<option value="{{ $car->id }}" @selected(old('car_id', $reservation->car_id ?? '') == $car->id)>{{ $car->brand }} {{ $car->model }} - {{ $car->registration_number }} / {{ $car->daily_price }} DH</option>@endforeach</select></label>
<label>Client<select name="client_id" required>@foreach($clients as $client)<option value="{{ $client->id }}" @selected(old('client_id', $reservation->client_id ?? '') == $client->id)>{{ $client->full_name }}</option>@endforeach</select></label>
<label>Date debut<input type="date" name="start_date" value="{{ old('start_date', $reservation->start_date ?? '') }}" required></label>
<label>Date fin<input type="date" name="end_date" value="{{ old('end_date', $reservation->end_date ?? '') }}" required></label>
<label>Statut<select name="status"><option>En cours</option><option>Terminee</option><option>Annulee</option></select></label>
<label>Notes<textarea name="notes">{{ old('notes', $reservation->notes ?? '') }}</textarea></label>
<button class="btn">Enregistrer</button>
</form>
@if($errors->any())<div class="errors">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
