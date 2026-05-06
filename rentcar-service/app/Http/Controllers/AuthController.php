<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Authentification administrateur.
 * Ce contrôleur gère l'affichage du formulaire de connexion,
 * la validation des identifiants, la création de la session et la déconnexion.
 */
class AuthController extends Controller
{
    /** Affiche la page de connexion admin. */
    public function showLogin()
    {
        return view('auth.login');
    }

    /** Traite la tentative de connexion. */
    public function login(Request $request)
    {
        // Validation des champs envoyés par le formulaire.
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Auth::attempt vérifie l'email et le mot de passe hashé dans la table users.
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Régénère la session pour éviter les attaques de fixation de session.
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withErrors(['email' => 'Email ou mot de passe incorrect.'])
            ->onlyInput('email');
    }

    /** Déconnecte l'administrateur. */
    public function logout(Request $request)
    {
        Auth::logout();

        // Nettoyage complet de la session après déconnexion.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Vous êtes déconnecté.');
    }
}
