<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'nom' => 'required|string|max:255|unique:produits,nom',
            'description' => 'nullable|string|max:1000',
            'prix_unitaire' => 'required|numeric|min:0',
            'tva' => 'required|numeric|min:0|max:100',
            'stock' => 'nullable|integer|min:0',
        ]);

        $produit = new Produit();
        $produit->nom = $data['nom'];
        $produit->description = $data['description'] ?? null;
        $produit->prix_unitaire = $data['prix_unitaire'];
        $produit->tva = $data['tva'];
        $produit->stock = $data['stock'] ?? 0;
        $produit->save();

        return response()->json([
            'message' => 'Produit created successfully',
            'produit' => $produit,
        ], 201);
    }

    public function index()
    {
        $produits = Produit::all();
        return response()->json($produits, 200);
    }

    public function update_produit(Request $request , $id) {
        $produit = Produit::find($id);
        if (!$produit) {
            return response()->json(['message' => 'Produit not found'], 404);
        }

        $data = $request->validate([
            'nom' => 'required|string|max:255|unique:produits,nom,' . $id,
            'description' => 'nullable|string|max:1000',
            'prix_unitaire' => 'required|numeric|min:0',
            'tva' => 'required|numeric|min:0|max:100',
            'stock' => 'nullable|integer|min:0',
        ]);

        $produit->nom = $data['nom'];
        $produit->description = $data['description'] ?? null;
        $produit->prix_unitaire = $data['prix_unitaire'];
        $produit->tva = $data['tva'];
        $produit->stock = $data['stock'] ?? 0;
        $produit->save();

        return response()->json([
            'message' => 'Produit updated successfully',
            'produit' => $produit,
        ], 200);
    }

    public function delete_produit($id) {
        $produit = Produit::find($id);
        if (!$produit) {
            return response()->json(['message' => 'Produit not found'], 404);
        }
        $produit->delete();
        return response()->json(['message' => 'Produit deleted successfully'], 200);
    }

    public function chercherProduit(Request $request) {
        $produit = Produit::query() ;
        if($request->has('nom')) {
            $produit->where('nom' , 'like' , '%' . $request->nom . '%') ;
        }
        // recuprerer des resultats
        $resultat = $produit->get() ;

        if($resultat->isEmpty()){
            return response()->json([
                'message' => 'Aucun produit trouvé',
                'data' =>  []
             ], 404) ;
        }
        return response()->json([
            'message' => 'Produits trouvés',
            'data' =>  $resultat
        ], 200) ;
    }
}
