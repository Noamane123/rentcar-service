<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Reservation
 * Lie un client à une voiture sur une période donnée.
 */
class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'client_id',
        'date_debut',
        'date_fin',
        'prix_total',
        'statut',
        'notes',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
