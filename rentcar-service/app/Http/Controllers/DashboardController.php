<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\Reservation;

/**
 * Contrôleur du tableau de bord.
 * Prépare les indicateurs principaux pour l'accueil de l'application.
 */
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalCars' => Car::count(),
            'availableCars' => Car::where('statut', 'disponible')->count(),
            'totalClients' => Client::count(),
            'activeReservations' => Reservation::where('statut', 'active')->count(),
            'latestReservations' => Reservation::with(['car', 'client'])->latest()->take(5)->get(),
            'latestClients' => Client::latest()->take(6)->get(),
        ]);
    }
}
