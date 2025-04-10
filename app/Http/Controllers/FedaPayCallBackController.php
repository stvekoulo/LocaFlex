<?php

namespace App\Http\Controllers;

use FedaPay\FedaPay;
use App\Models\Paiement;
use FedaPay\Transaction;
use App\Mail\PaymentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class FedaPayCallBackController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        // Clé API FedaPay
        $fedaPayApiKey = 'sk_sandbox_c2PnKt7VQHkT8yZf-dIoP9cG';
        FedaPay::setApiKey($fedaPayApiKey);
        FedaPay::setEnvironment('sandbox'); // 'sandbox' ou 'live'

        $id = $request->input('id');

        if (!$id) {
            session()->flash('error', __('Identifiant de transaction manquant.'));
            return redirect(route('payment.index'));
        }

        try {
            $transaction = Transaction::retrieve($id);

            $paiement = Paiement::where('reference', $id)->first();

            if (!$paiement) {
                session()->flash('error', __('Paiement non trouvé.'));
                return redirect(route('payment.index'));
            }

            if ($transaction->status === 'approved') {
                $paiement->update(['etat' => 'Paiement effectué']);

                Mail::to($paiement->client->email)->send(new PaymentMail($paiement->client));

                session()->flash('status', __('Votre paiement a été effectué avec succès. Merci pour votre confiance.'));
            } else {
                session()->flash('error', __('Votre paiement a été annulé ou refusé. Veuillez relancer si vous souhaitez payer votre produit.'));
            }

        } catch (\Exception $e) {
            session()->flash('error', __('Une erreur est survenue lors de la vérification du paiement.'));
        }

        return redirect(route('payment.index'));
    }
}
