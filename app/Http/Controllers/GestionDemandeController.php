<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemandeService;
use App\Models\DemandeReservation;

class GestionDemandeController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;

        $demandes = DemandeReservation::where('owner_id', $userId)->get();
        $demandeservices = DemandeService::where('owner_id', $userId)->get();

        return view('loueur.gestion_demande.index', compact('demandes', 'demandeservices'));
    }
}
