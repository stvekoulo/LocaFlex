<?php

namespace App\Http\Controllers;

use NotchPay\Payment;
use NotchPay\NotchPay;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Mail\PaymentMail;
use Mail;

class NotchPayCallBackController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        NotchPay::setApiKey('pk_test.FEbyEUllEnbFfutIxmr9QAe8g1rxWWPKYwG1lc97IX0duBMrXSqEON6cgvBvAqrRoN0M1Xf3DPiovn0eoj3I4aY9w8xiDcG4I8GcbNCqqTfWDlgskcewAVnIqgFmO');

        $verifyTransaction = Payment::verify($request->get('reference'));

        if ($verifyTransaction->transaction->status === 'canceled') {
            session()->flash('error', __('Votre paiement a été annulé veuillez relancer si vous souhaitez payer votre produit, Merci.'));
        } else {
            // Mise à jour de l'état du paiement dans la base de données
            $paiement->update(['etat' => 'Paiement effectué']);

            Mail::to($paiement->user->email)->send(new PaymentMail($paiement->user));

            session()->flash('status', __('Votre paiement a été effectué avec succès, Merci pour votre confiance.'));
        }

        return redirect(route('payment.index'));
    }
}
