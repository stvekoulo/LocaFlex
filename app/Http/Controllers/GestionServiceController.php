<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GestionServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('user_id', Auth::id())->get();
        return view('loueur.gestion_service.index', compact('services'));
    }

    public function create()
    {
        return view('loueur.gestion_service.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'tags' => 'required|string|max:255',
            'description' => 'required|string',
            'disponibilite' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $publication = false;

        $service = Service::create([
            'titre' => $request->titre,
            'categorie' => $request->categorie,
            'prix' => $request->prix,
            'tags' => $request->tags,
            'description' => $request->description,
            'disponibilite' => $request->disponibilite,
            'user_id' => Auth::id(),
            'publie' => $publication,
        ]);

        return redirect()->back()->with('success', 'Service enregistré avec succès!');
    }

    public function publicationtrue(Request $request)
    {
        $serviceId = $request->input('service_id');

        try {
            $service = Service::findOrFail($serviceId);
            $serviceTitre = $service->titre;

            $service->publie = true;

            $service->save();

            return redirect()->back()->with('success', 'Vous avez autorise la publication de ce service');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }

    public function publicationfalse(Request $request)
    {
        $serviceId = $request->input('service_id');

        try {
            $service = Service::findOrFail($serviceId);
            $serviceTitre = $service->titre;

            $service->publie = false;

            $service->save();

            return redirect()->back()->with('success', 'Vous avez retiré la publication de ce service');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->back()->with('success', 'Le service a été supprimé avec succès.');
    }

    public function edit($id)
    {
        $services = Service::findOrFail($id);
        return view('loueur.gestion_service.edit', compact('services'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'tags' => 'required|string|max:255',
            'description' => 'required|string',
            'disponibilite' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $service = Service::findOrFail($id);
        $service->titre = $request->titre;
        $service->categorie = $request->categorie;
        $service->prix = $request->prix;
        $service->tags = $request->tags;
        $service->description = $request->description;
        $service->disponibilite = $request->disponibilite;
        $service->save();

        return redirect()->back()->with('success', 'Le service a été mise à jour avec succès');
    }
}
