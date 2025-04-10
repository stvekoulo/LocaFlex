<?php

namespace App\Http\Controllers;

use FedaPay\FedaPay;
use App\Models\Paiement;
use FedaPay\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($paiementId): RedirectResponse
    {
        $fedaPayApiKey = 'sk_sandbox_c2PnKt7VQHkT8yZf-dIoP9cG';

        $payment = Paiement::findOrFail($paiementId);

        try {
            // Initialisation de FedaPay
            FedaPay::setApiKey($fedaPayApiKey);
            FedaPay::setEnvironment('sandbox'); // 'sandbox' ou 'live'

            $transaction = Transaction::create([
                "description" => "Paiement pour " . ($payment->bien_id ? $payment->bien->titre : $payment->services->titre),
                "amount" => $payment->montant,
                "currency" => ["iso" => "XOF"],
                "callback_url" => route('fedapay-callback'),
                "customer" => [
                    "firstname" => Auth::user()->name,
                    "lastname" => "",
                    "email" => Auth::user()->email,
                    "phone" => Auth::user()->phone ?? ""
                ]
            ]);

            $token = $transaction->generateToken();

            $payment->update(['reference' => $transaction->id]);

            return redirect($token->url);

        } catch (\Exception $e) {
            session()->flash('error', __('Impossible de procéder au paiement, veuillez recommencer plus tard. Merci'));
            return back();
        }
    }
}
