<?php

use Illuminate\Http\Request;


    Route::prefix('v1')->group(function(){
  
    Route::group(['middleware' => 'auth:api'], function() {
    Route::get('getUser', 'Api\AuthController@getUser');
    });
    Route::post('login','Api\AuthController@login');
    Route::post('register', 'Api\AuthController@register');
    
   
    Route::group(['middleware' =>'auth:api'], function() {
        Route::get('album', 'AlbumController@index');
        Route::post('album', 'AlbumController@create');
        Route::post('/album/{id}', 'AlbumController@update');
        Route::delete('album/{id}', 'AlbumController@delete');
        Route::get('album','AlbumController@search');
        Route::put('album/bloquer/{id}','AlbumController@bloquer');
     
    });
    
    
    
     Route::group(['middleware' => 'auth:api'], function() {
        Route::get('maison_production', 'maison_productionController@index');
        Route::post('maison_production', 'maison_productionController@create');
        Route::post('/maison_production/{id}', 'maison_productionController@update');
        Route::delete('maison_production/{id}', 'maison_productionController@delete');
        Route::get('maison_production','maison_productionController@search');
        Route::put('maison_production/bloquer/{id}','maison_productionController@bloquer');
     
    });
    
     Route::group(['middleware' => 'auth:api'], function() { 
         
         
          Route::post('upload', 'FichierController@fileUploadPost');
     });
    
    
});
