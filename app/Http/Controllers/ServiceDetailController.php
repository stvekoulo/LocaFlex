<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\DemandeService;

class ServiceDetailController extends Controller
{
    public function index($id)
    {
        $service = Service::findOrFail($id);

        return view('details_service', compact('service'));
    }

    public function envoyerDemande(Request $request)
    {
        $request->validate([
            'duree' => 'required|integer',
            'motif' => 'required|string',
        ]);

        $service = Service::find($request->service_id);

        if (!$service) {
            return back()->with('error', 'une erreur c\'est produite');
        }

        DemandeService::create([
            'service_id' => $request->service_id,
            'duree' => $request->duree,
            'motif' => $request->motif,
            'user_id' => auth()->user()->id,
            'owner_id' => $service->user_id,
            'etat' => 'En attente',
        ]);

        return back()->with('success', 'Votre demande pour ce service a été envoyée avec succès!');
    }
}
