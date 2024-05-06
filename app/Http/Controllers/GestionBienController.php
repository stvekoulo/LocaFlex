<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GestionBienController extends Controller
{
    public function index()
    {
        $biens = Bien::where('user_id', Auth::id())->get();
        return view('loueur.gestion_bien.index', compact('biens'));
    }

    public function create()
    {
        return view('loueur.gestion_bien.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'emplacement' => 'required|string|max:255',
            'tags' => 'required|string|max:255',
            'description' => 'required|string',
            'disponibilite' => 'required|string|max:255',
            'caracteristiques' => 'required|string',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $publication = false;

        $bien = Bien::create([
            'titre' => $request->titre,
            'categorie' => $request->categorie,
            'prix' => $request->prix,
            'emplacement' => $request->emplacement,
            'tags' => $request->tags,
            'description' => $request->description,
            'disponibilite' => $request->disponibilite,
            'caracteristiques' => $request->caracteristiques,
            'user_id' => Auth::id(),
            'publie' => $publication,
        ]);

        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $image) {
                $path = $image->store('photos');
                $description = 'photo_du_bien';
                Photo::create([
                    'chemin_fichier' => $path,
                    'description' => $description,
                    'bien_id' => $bien->id,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Bien enregistré avec succès!');
    }

    public function publicationtrue(Request $request)
    {
        $bienId = $request->input('bien_id');

        try {
            $bien = Bien::findOrFail($bienId);
            $bienTitre = $bien->titre;

            $bien->publie = true;

            $bien->save();

            return redirect()
                ->back()
                ->with('success', 'Vous avez autorise la publication de ce bien');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }

    public function publicationfalse(Request $request)
    {
        $bienId = $request->input('bien_id');

        try {
            $bien = Bien::findOrFail($bienId);
            $bienTitre = $bien->titre;

            $bien->publie = false;

            $bien->save();

            return redirect()
                ->back()
                ->with('success', 'Vous avez retiré la publication de ce bien');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }

    public function destroy($id)
    {
        $bien = Bien::findOrFail($id);
        $bien->delete();
        Photo::where('bien_id', $id)->delete();
        return redirect()->back()->with('success', 'Le bien a été supprimé avec succès.');
    }

    public function edit($id)
    {
        $biens = Bien::findOrFail($id);
        return view('loueur.gestion_bien.edit', compact('biens'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'emplacement' => 'required|string|max:255',
            'tags' => 'required|string|max:255',
            'description' => 'required|string',
            'disponibilite' => 'required|string|max:255',
            'caracteristiques' => 'required|string',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $bien = Bien::findOrFail($id);
        $bien->titre = $request->titre;
        $bien->categorie = $request->categorie;
        $bien->prix = $request->prix;
        $bien->emplacement = $request->emplacement;
        $bien->tags = $request->tags;
        $bien->description = $request->description;
        $bien->disponibilite = $request->disponibilite;
        $bien->tags = $request->tags;
        $bien->save();

        return redirect()->back()->with('success', 'Le bien a été mise à jour avec succès');
    }
}
