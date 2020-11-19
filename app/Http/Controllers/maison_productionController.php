<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maison_production;
use App\User;
use App\Fichier;
use Illuminate\Support\Facades\Auth;

class maison_productionController extends Controller {

    //index(show all)
    public function index() {
        return Maison_production::all();
    }

    //index(display data)
    public function create(request $request) {

        $idLogo = $this->upload($request, 'logo');


        $user = Auth::user();
        $maison_production = new Maison_production;
        $maison_production->raison_sociale = $request->raison_sociale;
        $maison_production->logo = $idLogo;
        $maison_production->description = $request->description;
        $maison_production->annee_creation = $request->annee_creation;
        $maison_production->site_web = $request->site_web;
        $maison_production->page_facebook = $request->page_facebook;
        $maison_production->page_youtube = $request->page_youtube;
        $maison_production->page_instagram = $request->page_instagram;
        $maison_production->page_twitter = $request->page_twitter;
        $maison_production->numero_telephone = $request->numero_telephone;
        $maison_production->numero_telephone_2 = $request->numero_telephone_2;
        $maison_production->numero_whatsapp = $request->numero_whatsapp;
        $maison_production->hash = $request->hash;
        $maison_production->pkey = $request->pkey;
        $maison_production->email = $request->email;
        $maison_production->admin = $user->id;
        $maison_production->bloquer = $request->bloquer;

        $maison_production->save();

        return response()->json(['success' => "Data successfully entered"], 200);
    }

    //index(update data)
    public function update(request $request, $id) {


        $maison_production = Maison_production::find($id);

        if ($request->logo) {
            $cheminLogo = $this->Updateupload($request, 'logo');
            $logo = Fichier::where('id', $maison_production->logo);
            $OldPath = $logo->value('chemin');
            $logo->update(['chemin' => $cheminLogo]);
        }


        if (file_exists($OldPath)) {
            unlink($OldPath);
        }

        $update = [
            'raison_sociale' => $request->raison_sociale,
            'description' => $request->description,
            'annee_creation' => $request->annee_creation,
            'site_web' => $request->site_web,
            'page_facebook' => $request->page_facebook,
            'page_youtube' => $request->page_youtube,
            'page_instagram' => $request->page_instagram,
            'page_twitter' => $request->page_twitter,
            'numero_telephone' => $request->numero_telephone,
            'numero_telephone_2' => $request->numero_telephone_2,
            'numero_whatsapp' => $request->numero_whatsapp,
            'hash' => $request->hash,
            'pkey' => $request->pkey,
            'email' => $request->email,
        ];
        Maison_production::where('id', $id)->update($update);

        return response()->json(['success' => "Data successfully update"], 200);
    }

    //delete

    public function delete($id) {
        $maison_production = Maison_production::find($id);
        $maison_production->delete();


        return response()->json(['success' => "Data successfully delete"], 200);
    }

    public function search(Request $request) {
        $search = $request->get('q');
        $result = Maison_production::where('raison_sociale', 'LIKE', '%' . $search . '%')->get();
        return response()->json($result);
    }

    public function bloquer(request $request, $id) {
        $maison_production = Maison_production::find($id);
        if ($maison_production->bloquer) {
            $maison_production->bloquer = 0;
        } else {
            $maison_production->bloquer = 1;
        }

        $maison_production->update([
            'bloquer' => $request->bloquer,
        ]);

        return response()->json(['success' => "Data successfully update"], 200);
    }

    protected function upload(Request $request, $field) {
        $request->validate([
            $field => 'required|mimes:zip|max:300000',
        ]);

        $fileName = time() . '.' . $request->file($field)->extension();

        $request->file($field)->move(public_path('uploads'), $fileName);

        // Save In Database
        $fichier = new Fichier();

        $fichier->chemin = "C:\laragon\www\LaravelApiProject\public\uploads.$fileName";

        $fichier->date_creation = "2019_12_12";
        $fichier->save();

        return $fichier->id;
    }

    protected function Updateupload(Request $request, $field) {


        $request->validate([
            $field => 'required|mimes:zip|max:300000',
        ]);

        $fileName = time() . '.' . $request->file($field)->extension();

        $request->file($field)->move(public_path('uploads'), $fileName);

        // Save In Database

        return "C:\laragon\www\LaravelApiProject\public\uploads.$fileName";
    }

}
