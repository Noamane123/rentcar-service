<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Utilisateur de l'application.
 * Le champ role permet de séparer les permissions:
 * - admin: accès complet, gestion des utilisateurs et des voitures
 * - car_manager: consultation du parc et gestion opérationnelle des réservations/clients
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /** Vérifie si l'utilisateur connecté possède un rôle donné. */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /** Les administrateurs ont toutes les permissions métier. */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
