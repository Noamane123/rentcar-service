<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Compte administrateur: accès complet, y compris utilisateurs et voitures.
        User::updateOrCreate(
            ['email' => 'admin@rentcar.local'],
            [
                'name' => 'Administrateur',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // Compte car manager: peut travailler sur les clients/réservations,
        // mais ne peut pas ajouter/modifier les voitures ni gérer les utilisateurs.
        User::updateOrCreate(
            ['email' => 'manager@rentcar.local'],
            [
                'name' => 'Car Manager',
                'role' => 'car_manager',
                'password' => Hash::make('manager123'),
            ]
        );

        Car::insert([
            ['marque' => 'Renault', 'modele' => 'Clio', 'immatriculation' => 'AA-123-AA', 'annee' => 2021, 'prix_jour' => 280, 'statut' => 'disponible', 'description' => 'Citadine économique idéale pour la ville.', 'created_at' => now(), 'updated_at' => now()],
            ['marque' => 'Dacia', 'modele' => 'Duster', 'immatriculation' => 'BB-456-BB', 'annee' => 2022, 'prix_jour' => 420, 'statut' => 'disponible', 'description' => 'SUV confortable pour familles et longs trajets.', 'created_at' => now(), 'updated_at' => now()],
            ['marque' => 'Peugeot', 'modele' => '208', 'immatriculation' => 'CC-789-CC', 'annee' => 2020, 'prix_jour' => 300, 'statut' => 'maintenance', 'description' => 'Voiture moderne et agréable à conduire.', 'created_at' => now(), 'updated_at' => now()],
            ['marque' => 'Toyota', 'modele' => 'Corolla', 'immatriculation' => 'DD-222-DD', 'annee' => 2023, 'prix_jour' => 520, 'statut' => 'disponible', 'description' => 'Berline fiable pour usage professionnel.', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Client::insert([
            ['nom' => 'Benali', 'prenom' => 'Youssef', 'telephone' => '0600000001', 'email' => 'youssef@example.com', 'cin_permis' => 'P123456', 'adresse' => 'Casablanca', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Martin', 'prenom' => 'Claire', 'telephone' => '0600000002', 'email' => 'claire@example.com', 'cin_permis' => 'P654321', 'adresse' => 'Rabat', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'El Amrani', 'prenom' => 'Sara', 'telephone' => '0600000003', 'email' => 'sara@example.com', 'cin_permis' => 'P777888', 'adresse' => 'Marrakech', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
