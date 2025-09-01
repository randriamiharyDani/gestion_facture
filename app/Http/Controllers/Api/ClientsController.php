<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients, 200);
    }
    public function store(Request $request)
    {
        // nom ,email , telephone , adresse , entreprise
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'entreprise' => 'nullable|string|max:255',
        ]);
        // Create a new client instance
        $client = new Client();
        $client->nom = $data['nom'];
        $client->email = $data['email'];
        $client->telephone = $data['telephone'];
        $client->adresse = $data['adresse'];
        $client->entreprise = $data['entreprise'] ?? null;
        $client->save();
        // Return a response
        return response()->json([
            'message' => 'Client created successfully',
            'client' => $client,
        ], 201);
    }

    public function delete_client($id)
    {

        // return "delete" ;
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully'], 200);
    }

    public function update_client(Request $request ,$id) {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'entreprise' => 'nullable|string|max:255',
        ]);

        $client->nom = $data['nom'];
        $client->email = $data['email'];
        $client->telephone = $data['telephone'];
        $client->adresse = $data['adresse'];
        $client->entreprise = $data['entreprise'] ?? null;
        $client->save();

        return response()->json([
            'message' => 'Client updated successfully',
            'client' => $client,
        ], 200);

    }

    public function get_single_client($id) {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }
        return response()->json($client, 200);
    }

    // Tableau avec recherche
    public function chercherClient(Request $request)
    {
        $query = Client::query();

        //  Recherche
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        // 🔃 Tri dynamique
        $sortBy = $request->input('sort_by', 'nom'); // champ par défaut
        $sortOrder = $request->input('sort_order', 'asc'); // asc ou desc
        $query->orderBy($sortBy, $sortOrder);

        // 📄 Pagination
        $perPage = $request->input('per_page', 10); // nombre d’éléments par page
        $clients = $query->paginate($perPage);

        return response()->json($clients);
    }



}
