<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_facture extends Model
{
   protected $table = 'detail_factures';
    protected $fillable = [
          'facture_id',
          'produit_id',
          'quantite',
          'prix_unitaire',
          'tva',
          'total_ligne'
     ];

    public function facture()
    {
        return $this->belongsTo(Facture::class, 'facture_id');
    }


     public function produit()
     {
          return $this->belongsTo(Produit::class);
     }
}
