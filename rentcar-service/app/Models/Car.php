<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Car
 * Représente une voiture disponible dans l'agence de location.
 */
class Car extends Model
{
    use HasFactory;

    /** Champs autorisés en création/modification de masse. */
    protected $fillable = [
        'marque',
        'modele',
        'immatriculation',
        'annee',
        'prix_jour',
        'statut',
        'image',
        'description',
    ];

    /** Une voiture peut avoir plusieurs réservations. */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
