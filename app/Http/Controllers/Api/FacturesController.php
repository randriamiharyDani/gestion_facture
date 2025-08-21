<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Detail_facture;
use App\Models\Facture;
use App\Models\Produit;
use Illuminate\Http\Request;

class FacturesController extends Controller
{
     public function store(Request $request) {

     $numero_facture = 'FAC-' . time();

       $facture = Facture::create([
            'numero_facture' => $numero_facture,
            'client_id' => $request->input('client_id'),
            'date_emission' => $request->input('date_emission'),
            'date_echeance' => $request->input('date_echeance'),
            'statut' => $request->input('statut', 'en attente'),
            'notes' => $request->input('notes', ''),
            // 'total_ht' => 0,
            // 'total_tva' => 0,
            // 'total_ttc' => 0
       ]);

        $total_ht = 0;
        $total_tva = 0;
        $total_ttc = 0;
        // 2. Ajouter les lignes de facture
        foreach ($request->input('lignes') as $ligne) {
            $produit = Produit::find($ligne['produit_id']);

            $ligne_total_ht = $produit->prix_unitaire * $ligne['quantite'];
            $ligne_total_tva = $ligne_total_ht * ($produit->tva / 100);
            $ligne_total_ttc = $ligne_total_ht + $ligne_total_tva;

            Detail_facture::create([
                'facture_id' => $facture->id,
                'produit_id' => $produit->id,
                'quantite' => $ligne['quantite'],
                'prix_unitaire' => $produit->prix_unitaire,
                'tva' => $produit->tva,
                'total_ht' => $ligne_total_ht,
                'total_tva' => $ligne_total_tva,
                'total_ttc' => $ligne_total_ttc,
                'total_ligne' => $ligne_total_ttc
            ]);



            // Calculer les totaux
            $total_ht += $ligne['quantite'] * $ligne['prix_unitaire'];
            $total_tva += $total_ht * ($ligne['tva'] / 100);
            $total_ttc += $ligne_total_ttc;

        }
        // 3. Mettre à jour la facture avec les totaux
        $facture->update([
            'total_ht' => $total_ht,
            'total_tva' => $total_tva,
            'total_ttc' => $total_ttc,
        ]);
        // 4. Retourner la facture créée
        return response()->json([
            'message' => 'Facture créée avec succès',
            'facture' => $facture
        ], 201);

     }

     public function index() {
          $factures = Facture::with('client', 'details.produit')->get();
          return response()->json($factures);
     }

     public function show($id) {
            $facture = Facture::with('client', 'details.produit')->find($id);

            if (!$facture) {
                 return response()->json(['message' => 'Facture non trouvée'], 404);
            }

            return response()->json($facture);
     }

     public function update_facture(Request $request , $id){

        $facture = Facture::find($id);
        if (!$facture) {
            return response()->json(['message' => 'Facture non trouvée'], 404);
        }
        $facture->update([
            'numero_facture' => $request->input('numero_facture', $facture->numero_facture),
            'client_id' => $request->input('client_id', $facture->client_id),
            'date_emission' => $request->input('date_emission', $facture->date_emission),
            'date_echeance' => $request->input('date_echeance', $facture->date_echeance),
            'statut' => $request->input('statut', $facture->statut),
            'notes' => $request->input('notes', $facture->notes),
        ]);
        // Recalculer les totaux si nécessaire
        $total_ht = 0;
        $total_tva = 0;
        $total_ttc = 0;
        // 2. Ajouter les lignes de facture
        foreach ($request->input('lignes') as $ligne) {
            $produit = Produit::find($ligne['produit_id']);

            $ligne_total_ht = $produit->prix_unitaire * $ligne['quantite'];
            $ligne_total_tva = $ligne_total_ht * ($produit->tva / 100);
            $ligne_total_ttc = $ligne_total_ht + $ligne_total_tva;

            Detail_facture::create([
                'facture_id' => $facture->id,
                'produit_id' => $produit->id,
                'quantite' => $ligne['quantite'],
                'prix_unitaire' => $produit->prix_unitaire,
                'tva' => $produit->tva,
                'total_ht' => $ligne_total_ht,
                'total_tva' => $ligne_total_tva,
                'total_ttc' => $ligne_total_ttc,
                'total_ligne' => $ligne_total_ttc
            ]);

            // Calculer les totaux
            $total_ht += $ligne['quantite'] * $ligne['prix_unitaire'];
            $total_tva += ($ligne['quantite'] * $ligne['prix_unitaire']) * ($ligne['tva'] / 100);
        }
        // 3. Mettre à jour la facture avec les totaux
        $facture->update([
            'total_ht' => $total_ht,
            'total_tva' => $total_tva,
            'total_ttc' => $total_ttc,
        ]);

        return response()->json([
            'message' => 'Facture mise à jour avec succès',
            'facture' => $facture
        ]);

     }

     public function delete_facture($id) {
          $facture = Facture::find($id);
          if (!$facture) {
               return response()->json(['message' => 'Facture non trouvée'], 404);
          }
          $facture->delete();
          return response()->json(['message' => 'Facture supprimée avec succès']);
     }

     public function get_facture_detail() {
        $facture_detail = Detail_facture::with('facture' , 'produit')
            ->get();
        return response()->json($facture_detail);

     }

}
