<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class maison_production extends Model
{
     protected $fillable = [
         'raison','logo','description','annee_creation','site_web','page_facebook','page_youtube','page_instagram','page_twitter','numero_telephone_','numero_telephone_2','numero_whatsapp','hash','pkey','email',
         
         ];
}
