<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $paymentsForBiens = Paiement::where('user_id', $user->id)
        ->whereNotNull('bien_id') // Pour filtrer par les paiements liés à un bien
        ->get();

    // Récupérer les paiements pour un service
    $paymentsForServices = Paiement::where('user_id', $user->id)
        ->whereNotNull('service_id') // Pour filtrer par les paiements liés à un service
        ->get();

        return view('payment', compact('paymentsForBiens', 'paymentsForServices'));
    }
}
