<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;
use App\Models\DemandeService;
use App\Models\DemandeReservation;
use App\Mail\DemandeBienRefuserMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemandeBienAccepterMail;
use App\Mail\DemandeServiceRefuserMail;
use App\Mail\DemandeServiceAccepterMail;

class GestionDemandeController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;

        $demandes = DemandeReservation::where('owner_id', $userId)->get();
        $demandeservices = DemandeService::where('owner_id', $userId)->get();

        return view('loueur.gestion_demande.index', compact('demandes', 'demandeservices'));
    }

    public function accepterDemandebien(Request $request, $demandeId)
    {
        $demande = DemandeReservation::findOrFail($demandeId);

        $utilisateur = Auth::user();

        $demande->update(['etat' => 'Validé']);

        Paiement::create([
            'montant' => $demande->bien->prix,
            'user_id' => $demande->user_id,
            'owner_id' => $utilisateur->id,
            'bien_id' => $demande->bien_id,
            'etat' => 'En attente de paiement',
        ]);

        Mail::to($demande->user->email)->send(new DemandeBienAccepterMail($demande->user));

        return back()->with('success', 'La demande a été acceptée avec succès.');
    }

    public function accepterDemandeservice(Request $request, $demandeId)
    {
        $demande = DemandeService::findOrFail($demandeId);

        $utilisateur = Auth::user();

        $demande->update(['etat' => 'Validé']);

        Paiement::create([
            'montant' => $demande->services->prix,
            'user_id' => $demande->user_id,
            'owner_id' => $utilisateur->id,
            'service_id' => $demande->service_id,
            'etat' => 'En attente de paiement',
        ]);

        Mail::to($demande->user->email)->send(new DemandeServiceAccepterMail($demande->user));

        return back()->with('success', 'Le service a été acceptée avec succès.');
    }

    public function refuserDemandebien(Request $request, $demandeId)
    {
        $demande = DemandeReservation::findOrFail($demandeId);

        $demande->update(['etat' => 'Refusé']);

        Mail::to($demande->user->email)->send(new DemandeBienRefuserMail($demande->user));

        return back()->with('success', 'La demande a été refusée avec succès.');
    }

    public function refuserDemandeservice(Request $request, $demandeId)
    {
        $demande = DemandeService::findOrFail($demandeId);

        $demande->update(['etat' => 'Refusé']);

        Mail::to($demande->user->email)->send(new DemandeServiceRefuserMail($demande->user));

        return back()->with('success', 'Le Service a été refusée avec succès.');
    }
}
