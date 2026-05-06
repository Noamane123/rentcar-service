<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

/**
 * Gestion CRUD des voitures.
 * La consultation est ouverte aux utilisateurs connectés,
 * mais les actions d'ajout/modification/suppression sont réservées à l'admin.
 */
class CarController extends Controller
{
    /** Vérifie que l'utilisateur connecté est administrateur. */
    private function ensureAdmin(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403, "Action réservée à l'administrateur.");
    }

    public function index(Request $request)
    {
        // Recherche simple par marque, modèle ou immatriculation.
        $cars = Car::query()
            ->when($request->search, function ($query, $search) {
                $query->where('marque', 'like', "%{$search}%")
                    ->orWhere('modele', 'like', "%{$search}%")
                    ->orWhere('immatriculation', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(8);

        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        $this->ensureAdmin();
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        // Validation côté serveur pour protéger les données.
        $data = $request->validate([
            'marque' => 'required|string|max:80',
            'modele' => 'required|string|max:80',
            'immatriculation' => 'required|string|max:30|unique:cars',
            'annee' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'prix_jour' => 'required|numeric|min:0',
            'statut' => 'required|in:disponible,louee,maintenance',
            'description' => 'nullable|string|max:1000',
        ]);

        Car::create($data);
        return redirect()->route('cars.index')->with('success', 'Voiture ajoutée avec succès.');
    }

    public function edit(Car $car)
    {
        $this->ensureAdmin();
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'marque' => 'required|string|max:80',
            'modele' => 'required|string|max:80',
            'immatriculation' => 'required|string|max:30|unique:cars,immatriculation,' . $car->id,
            'annee' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'prix_jour' => 'required|numeric|min:0',
            'statut' => 'required|in:disponible,louee,maintenance',
            'description' => 'nullable|string|max:1000',
        ]);

        $car->update($data);
        return redirect()->route('cars.index')->with('success', 'Voiture modifiée avec succès.');
    }

    public function destroy(Car $car)
    {
        $this->ensureAdmin();
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Voiture supprimée.');
    }
}
