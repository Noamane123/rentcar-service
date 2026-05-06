<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

/**
 * Gestion CRUD des clients de l'agence.
 */
class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::query()
            ->when($request->search, function ($query, $search) {
                $query->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%")
                    ->orWhere('cin_permis', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(8);

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:80',
            'prenom' => 'required|string|max:80',
            'telephone' => 'required|string|max:30',
            'email' => 'nullable|email|max:120',
            'cin_permis' => 'required|string|max:60|unique:clients',
            'adresse' => 'nullable|string|max:255',
        ]);

        Client::create($data);
        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès.');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:80',
            'prenom' => 'required|string|max:80',
            'telephone' => 'required|string|max:30',
            'email' => 'nullable|email|max:120',
            'cin_permis' => 'required|string|max:60|unique:clients,cin_permis,' . $client->id,
            'adresse' => 'nullable|string|max:255',
        ]);

        $client->update($data);
        return redirect()->route('clients.index')->with('success', 'Client modifié avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé.');
    }
}
