<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Client
 * Stocke les informations principales du client.
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'cin_permis',
        'adresse',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
