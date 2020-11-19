<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,
    Redirect,
    Response,
    File;
use App\Fichier;

class FichierController extends Controller {

    public function fileUploadPost(Request $request) {

        $request->validate([
            'file' => 'required|mimes:zip|max:300000',
        ]);



        $fileName = time() . '.' . $request->file->extension();



        $request->file->move(public_path('uploads'), $fileName);


        // Save In Database
        $fichier = new Fichier();

        $fichier->chemin = "C:\laragon\www\LaravelApiProject\public\uploads.$fileName";

        $fichier->date_creation = "2019_12_12";
        $fichier->save();







        return response()->json(['success' => "Great! Image has been successfully uploaded"], 200);
    }

}
