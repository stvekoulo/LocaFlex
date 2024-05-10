<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use NotchPay\NotchPay;
use NotchPay\Payment;


class PaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($paiementId): RedirectResponse
    {
        NotchPay::setApiKey('pk_test.FEbyEUllEnbFfutIxmr9QAe8g1rxWWPKYwG1lc97IX0duBMrXSqEON6cgvBvAqrRoN0M1Xf3DPiovn0eoj3I4aY9w8xiDcG4I8GcbNCqqTfWDlgskcewAVnIqgFmO');

        $payment = Paiement::findOrFail($paiementId);

        try {
            $payload = Payment::initialize([
                'amount' => $payment->montant,
                'email' => Auth::user()->email,
                'name' => Auth::user()->name,
                'currency' => 'XAF',
                'reference' => Auth::id() . '-' . uniqid(),
                'callback' => route('notchpay-callback'),
            ]);

            return redirect($payload->authorization_url);
        } catch (NotchPay\Exception\ApiException $e) {
            session()->flash('error', __('Impossible de procéder au paiement, veuillez recommencer plus tard. Merci'));

            return back();
        }
    }
}
