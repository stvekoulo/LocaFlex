<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $paymentsForBiens = Paiement::with('bien')
            ->where('user_id', $user->id)
            ->whereNotNull('bien_id')
            ->get();

        $paymentsForServices = Paiement::with('service')
            ->where('user_id', $user->id)
            ->whereNotNull('service_id')
            ->get();

        return view('payment', compact('paymentsForBiens', 'paymentsForServices'));
    }

}
