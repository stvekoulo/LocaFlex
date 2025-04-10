<?php

namespace App\Http\Controllers;

use FedaPay\FedaPay;
use App\Models\Paiement;
use FedaPay\Transaction;
use App\Mail\PaymentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class FedaPayCallBackController extends Controller
{
    public function handleCallback(Request $request, $id)
    {
        try {
            $paiement = Paiement::findOrFail($id);

            if ($paiement->etat === 'Payé') {
                return redirect()->route('payment.index')->with('success', __('Ce paiement a déjà été effectué.'));
            }

            // Initialisation de FedaPay
            FedaPay::setApiKey(config('services.fedapay.secret_key'));
            FedaPay::setEnvironment(config('services.fedapay.environment'));

            // Vérification de la transaction
            $transaction = Transaction::retrieve($paiement->reference);

            if ($transaction && $transaction->status === 'approved') {
                // Mise à jour du paiement
                $paiement->update([
                    'etat' => 'Payé',
                    'updated_at' => now()
                ]);

                // Envoi de l'email de confirmation
                try {
                    Mail::to($paiement->client->email)
                        ->send(new PaymentMail($paiement->client));
                    Log::info('Email de confirmation envoyé pour le paiement #' . $paiement->id);
                } catch (\Exception $e) {
                    Log::error('Erreur lors de l\'envoi de l\'email de confirmation: ' . $e->getMessage());
                }

                return redirect()->route('payment.index')->with('success', __('Votre paiement a été effectué avec succès.'));
            }

            return redirect()->route('payment.index')->with('error', __('Le paiement n\'a pas pu être validé. Veuillez réessayer.'));
        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement du callback FedaPay: ' . $e->getMessage());
            return redirect()->route('payment.index')->with('error', __('Une erreur est survenue lors du traitement de votre paiement.'));
        }
    }
}
