<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Services\FedaPayService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $fedaPayService;

    public function __construct(FedaPayService $fedaPayService)
    {
        $this->fedaPayService = $fedaPayService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke($paiementId): RedirectResponse
    {
        try {
            $payment = Paiement::findOrFail($paiementId);

            if ($payment->etat === 'Payé') {
                session()->flash('error', __('Ce paiement a déjà été effectué.'));
                return redirect(route('payment.index'));
            }

            // Création de la transaction
            $transaction = $this->fedaPayService->createTransaction($payment);

            // Génération du token de paiement
            $token = $transaction->generateToken();

            // Mise à jour de la référence du paiement
            $payment->update(['reference' => $transaction->id]);

            // Redirection vers la page de paiement FedaPay
            return redirect($token->url);

        } catch (\FedaPay\Error\ApiConnection $e) {
            Log::error('Erreur de connexion à FedaPay: ' . $e->getMessage());
            session()->flash('error', __('Erreur de connexion au service de paiement. Veuillez réessayer plus tard.'));
            return back();
        } catch (\FedaPay\Error\InvalidRequest $e) {
            Log::error('Requête invalide FedaPay: ' . $e->getMessage());
            session()->flash('error', __('Erreur dans la requête de paiement. Veuillez contacter le support.'));
            return back();
        } catch (\Exception $e) {
            Log::error('Erreur FedaPay: ' . $e->getMessage());
            session()->flash('error', __('Une erreur est survenue lors du traitement de votre paiement. Veuillez réessayer plus tard.'));
            return back();
        }
    }
}
