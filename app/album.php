<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class album extends Model
{
    protected $fillable = [
      'artiste','annee_sortie','genre_musical','type_album','copyright','cover_face_a','cover_face_b','date_sortie_officielle','precommandable','fichier','ficher_precommande','bonus_precommande','description','credits','producteur','tracklist','titre',
        
    ];
    
 
}
