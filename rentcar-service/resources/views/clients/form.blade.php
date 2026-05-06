<form class="form" method="POST" action="{{ $action }}">
@csrf
@if($method === 'PUT') @method('PUT') @endif
<label>Nom complet<input name="full_name" value="{{ old('full_name', $client->full_name ?? '') }}" required></label>
<label>Telephone<input name="phone" value="{{ old('phone', $client->phone ?? '') }}" required></label>
<label>Email<input type="email" name="email" value="{{ old('email', $client->email ?? '') }}"></label>
<label>CIN / Permis<input name="cin" value="{{ old('cin', $client->cin ?? '') }}"></label>
<label>Adresse<textarea name="address">{{ old('address', $client->address ?? '') }}</textarea></label>
<button class="btn">Enregistrer</button>
</form>
@if($errors->any())<div class="errors">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
