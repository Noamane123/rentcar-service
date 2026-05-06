<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Http\Request;

/**
 * Gestion des réservations.
 * Le prix total est calculé automatiquement selon le nombre de jours.
 */
class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['car', 'client'])->latest()->paginate(8);
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create', [
            'cars' => Car::orderBy('marque')->get(),
            'clients' => Client::orderBy('nom')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'client_id' => 'required|exists:clients,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'required|in:active,terminee,annulee',
            'notes' => 'nullable|string|max:1000',
        ]);

        $car = Car::findOrFail($data['car_id']);
        $days = max(1, now()->parse($data['date_debut'])->diffInDays(now()->parse($data['date_fin'])) + 1);
        $data['prix_total'] = $days * $car->prix_jour;

        Reservation::create($data);

        // Mettre la voiture en statut louée si la réservation est active.
        if ($data['statut'] === 'active') {
            $car->update(['statut' => 'louee']);
        }

        return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès.');
    }

    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', [
            'reservation' => $reservation,
            'cars' => Car::orderBy('marque')->get(),
            'clients' => Client::orderBy('nom')->get(),
        ]);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'client_id' => 'required|exists:clients,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'required|in:active,terminee,annulee',
            'notes' => 'nullable|string|max:1000',
        ]);

        $car = Car::findOrFail($data['car_id']);
        $days = max(1, now()->parse($data['date_debut'])->diffInDays(now()->parse($data['date_fin'])) + 1);
        $data['prix_total'] = $days * $car->prix_jour;

        $reservation->update($data);

        if ($data['statut'] === 'active') {
            $car->update(['statut' => 'louee']);
        } elseif (in_array($data['statut'], ['terminee', 'annulee'])) {
            $car->update(['statut' => 'disponible']);
        }

        return redirect()->route('reservations.index')->with('success', 'Réservation modifiée avec succès.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée.');
    }
}
