<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index(){
       $fournisseur  = Fournisseur::all() ;

       return response()->json([
        "message " => "Liste des fournisseurs",
        "fournisseurs" => $fournisseur
       ]);
    }
    public function store(Request $request){
         $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:fournisseurs,email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'entreprise' => 'nullable|string|max:255',
         ]) ;

         $fournisseur = new Fournisseur() ;
            $fournisseur->nom = $request->nom ;
            $fournisseur->email = $request->email ;
            $fournisseur->telephone = $request->telephone ;
            $fournisseur->adresse = $request->adresse ;
            $fournisseur->entreprise = $request->entreprise ?? null ;
            $fournisseur->save() ;

        return response()->json([
            'message' => 'Fournisseur created successfully',
            'fournisseur' => $fournisseur,
        ], 201);
    }

    public function deleteFournisseur($id){
        $fournisseur = Fournisseur::find($id) ;
        if(!$fournisseur){
            return response()->json([
                "message" => "Fournisseur not found"
            ],404) ;
        }
        $fournisseur->delete() ;
        return response()->json([
            "message" => "Fournisseur deleted successfully"
        ],200) ;
    }

    public function updateFournisseur(Request $request , $id){
        $fournisseur = Fournisseur::find($id) ;

        if(!$fournisseur){
            return response()->json([
                "message" => "Fournisseur not found"
            ],404) ;
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:fournisseurs,email,'.$id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'entreprise' => 'nullable|string|max:255',
         ]) ;

            $fournisseur->nom = $request->nom ;
            $fournisseur->email = $request->email ;
            $fournisseur->telephone = $request->telephone ;
            $fournisseur->adresse = $request->adresse ;
            $fournisseur->entreprise = $request->entreprise ?? null ;
            $fournisseur->save() ;

        return response()->json([
            'message' => 'Fournisseur updated successfully',
            'fournisseur' => $fournisseur,
        ], 200);
    }

    public function get_fournisseur($id){
        $fournisseur = Fournisseur::find($id) ;
        if(!$fournisseur){
            return response()->json([
                "message" => "Fournisseur not found"
            ],404) ;
        }
        return response()->json($fournisseur,200) ;
    }
}
