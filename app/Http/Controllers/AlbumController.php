<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\User;
use App\Fichier;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller {

    // index(show all)
    public function index() {
        return Album::all;

        }

    //index(display data)
    public function create(Request $request) {

        $idFichier = $this->upload($request, 'fichier');
        $idFichierPrecommande = $this->upload($request, 'fichier_precommande');
        $idCoverFaceA = $this->upload($request, 'cover_face_a');
        $idCoverFaceB = $this->upload($request, 'cover_face_b');

        $user = Auth::user();
        $album = new Album;
        $album->titre = $request->titre;
        $album->artiste = $request->artiste;
        $album->annee_sortie = $request->annee_sortie;
        $album->genre_musical = $request->genre_musical;
        $album->type_album = $request->type_album;
        $album->copyright = $request->copyright;
        $album->cover_face_a = $idCoverFaceA;
        $album->cover_face_b = $idCoverFaceB;
        $album->date_sortie_officielle = $request->date_sortie_officielle;
        $album->precommandable = $request->precommandable;
        $album->fichier = $idFichier;
        $album->fichier_precommande = $idFichierPrecommande;
        $album->bonus_precommande = $request->bonus_precommande;
        $album->description = $request->description;
        $album->credits = $request->credits;
        $album->producteur = $request->producteur;
        $album->tracklist = $request->tracklist;
        $album->admin = $user->id;
        $album->bloquer = $request->bloquer;

        $album->save();

        return response()->json(['success' => "Data successfully entered"], 200);
    }

    // index(update data)  
    public function update(request $request, $id) {
        $album = Album::find($id);




        if ($request->fichier) {
            $cheminFichier = $this->Updateupload($request, 'fichier');
            $fichier = Fichier::where('id', $album->fichier);
            $OldPath = $fichier->value('chemin');
            $fichier->update(['chemin' => $cheminFichier]);

            if (file_exists($OldPath)) {
                unlink($OldPath);
            }
        }

        if ($request->fichier_precommande) {
            $cheminFichierprecommande = $this->Updateupload($request, 'fichier_precommande');
            $fichierPrecommande = Fichier::where('id', $album->fichier_precommande);
            $OldPath = $fichierPrecommande->value('chemin');
            $fichierPrecommande->update(['chemin' => $cheminFichierprecommande]);


            if (file_exists($OldPath)) {
                unlink($OldPath);
            }
        }

        if ($request->cover_face_a) {
            $cheminCoverfacea = $this->Updateupload($request, 'cover_face_a');
            $coverFaceA = Fichier::where('id', $album->cover_face_a);
            $OldPath = $coverFaceA->value('chemin');
            $coverFaceA->update(['chemin' => $cheminCoverfacea]);



            if (file_exists($OldPath)) {
                unlink($OldPath);
            }
        }

        if ($request->cover_face_b) {
            $cheminCoverfaceb = $this->Updateupload($request, 'cover_face_b');
            $coverFaceB = Fichier::where('id', $album->cover_face_b);
            $OldPath = $coverFaceB->value('chemin');
            $coverFaceB->update(['chemin' => $cheminCoverfaceb]);



            if (file_exists($OldPath)) {
                unlink($OldPath);
            }
        }


        $update = ['titre' => $request->titre,
            'artiste' => $request->artiste,
            'titre' => $request->titre,
            'annee_sortie' => $request->annee_sortie,
            'genre_musical' => $request->genre_musical,
            'type_album' => $request->type_album,
            'copyright' => $request->copyright,
            'date_sortie_officielle' => $request->date_sortie_officielle,
            'precommandable' => $request->precommandable,
            'description' => $request->description,
            'credits' => $request->credits,
            'producteur' => $request->producteur,
            'tracklist' => $request->tracklist,
        ];
        Album::where('id', $id)->update($update);




        return response()->json(['success' => "Data successfully update"], 200);
    }

    //delete
    public function delete($id) {
        $album = Album::find($id);
        $album->delete();


        return response()->json(['success' => "Data successfully delete"], 200);
    }
   
        // rechercher 
    
    public function search(Request $request) {
        $search = $request->get('q');
        $result = Album::where('artiste', 'LIKE', '%' . $search . '%')->get();
        return response()->json($result);
    }
    
    // bloquer et debloquer

    public function bloquer(request $request, $id) {
        $album = Album::find($id);
        if ($album->bloquer) {
            $album->bloquer = 0;
        } else {
            $album->bloquer = 1;
        }

        $album->update([
            'bloquer' => $request->bloquer,
        ]);

        return response()->json(['success' => "Data successfully bloquer"], 200);
    }

        //upload un champ
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

    //update et upload un champ
    protected function Updateupload(Request $request, $field) {

 
        $request->validate([
            $field => 'mimes:zip|max:300000',
        ]);


        $fileName = time() . '.' . $request->file($field)->extension();


        $request->file($field)->move(public_path('uploads'), $fileName);

        // Save In Database

        return "C:\laragon\www\LaravelApiProject\public\uploads.$fileName";
    }

}
