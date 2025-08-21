<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $table = 'factures';
    protected $fillable = [
        'numero_facture',
        'client_id',
        'date_emission',
        'date_echeance',
        'statut',
        'total_ht',
        'total_tva',
        'total_ttc',
        'notes'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'facture_produit')
                    ->withPivot('quantite', 'prix_unitaire', 'total');
    }

    public function details()
    {
        return $this->hasMany(Detail_facture::class);
    }
}
