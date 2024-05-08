<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use Illuminate\Http\Request;
use App\Models\DemandeReservation;
use App\Mail\DemandeReservatioMail;
use Mail;

class BienDetailController extends Controller
{
    public function index($id)
    {
        $bien = Bien::with('photos')->findOrFail($id);

        $biens = Bien::with(['photos' => function ($query) {
            $query->take(1);
        }])->findOrFail($id);

        return view('details_bien', compact('bien', 'biens'));
    }

    public function envoyerDemande(Request $request)
    {
        $request->validate([
            'duree' => 'required|integer',
            'motif' => 'required|string',
        ]);

        $bien = Bien::find($request->bien_id);

        if (!$bien) {
            return back()->with('error', 'une erreur c\'est produite');
        }

        DemandeReservation::create([
            'bien_id' => $request->bien_id,
            'duree' => $request->duree,
            'motif' => $request->motif,
            'user_id' => auth()->user()->id,
            'owner_id' => $bien->user_id,
            'etat' => 'En attente',
        ]);

        Mail::to($bien->user->email)->send(new DemandeReservatioMail($bien->user));

        return back()->with('success', 'Votre demande de réservation a été envoyée avec succès! Vous serez informez par mail si la demande est accepté ou refusez ');
    }
}
