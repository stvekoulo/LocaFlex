<?php

namespace App\Services;

use FedaPay\FedaPay;
use FedaPay\Transaction;
use App\Models\Paiement;
use Illuminate\Support\Facades\Log;

class FedaPayService
{
    public function __construct()
    {
        FedaPay::setApiKey(config('services.fedapay.secret_key'));
        FedaPay::setEnvironment(config('services.fedapay.environment'));

        Log::info('FedaPay Config:', [
            'api_key_set' => !empty(config('services.fedapay.secret_key')),
            'environment' => config('services.fedapay.environment'),
            'currency' => config('services.fedapay.currency', 'XOF'),
        ]);
    }

    public function createTransaction(Paiement $paiement)
    {
        try {
            $transactionData = [
                'description' => 'Paiement pour ' . ($paiement->bien_id ? $paiement->bien->titre : $paiement->service->titre),
                'amount' => (int)$paiement->montant,
                'currency' => [
                    'iso' => config('services.fedapay.currency', 'XOF')
                ],
                'callback_url' => route('fedapay-callback', ['id' => $paiement->id]),
                'customer' => [
                    'firstname' => $paiement->client->name,
                    'lastname' => '',
                    'email' => $paiement->client->email,
                    'phone' => $paiement->client->phone ?? ''
                ]
            ];

            Log::info('Données de transaction FedaPay:', $transactionData);

            $transaction = Transaction::create($transactionData);

            Log::info('Transaction FedaPay créée:', ['id' => $transaction->id ?? 'non défini']);

            return $transaction;
        } catch (\Exception $e) {
            Log::error('Erreur FedaPay détaillée: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function getPaymentUrl($transaction)
    {
        try {
            if (empty($transaction->id)) {
                throw new \Exception("La transaction FedaPay n'a pas d'ID valide");
            }

            $token = $transaction->generateToken();
            Log::info('Token FedaPay généré:', ['token' => $token->token, 'url' => $token->url]);

            return $token->url;
        } catch (\Exception $e) {
            Log::error('Erreur génération URL FedaPay: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function verifyTransaction($transactionId)
    {
        try {
            $transaction = Transaction::retrieve($transactionId);
            return $transaction;
        } catch (\Exception $e) {
            Log::error('Erreur vérification transaction FedaPay: ' . $e->getMessage());
            return null;
        }
    }

    public function createEventTransaction($transactionData)
    {
        try {
            Log::info('Données de transaction FedaPay pour événement:', $transactionData);

            $transaction = Transaction::create($transactionData);

            Log::info('Transaction FedaPay pour événement créée:', ['id' => $transaction->id ?? 'non défini']);

            return $transaction;
        } catch (\Exception $e) {
            Log::error('Erreur FedaPay événement détaillée: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function createProductTransaction($order)
    {
        try {
            $transactionData = [
                'description' => 'Achat de produit(s) - Commande #' . $order->id,
                'amount' => (int)$order->total_amount,
                'currency' => [
                    'iso' => (env('FEDAPAY_CURRENCY', 'XOF'))
                ],
                'callback_url' => route('fedapay.callback'),
                'customer' => [
                    'firstname' => $order->customer_first_name ?? explode(' ', $order->customer_name)[0] ?? '',
                    'lastname' => $order->customer_last_name ?? (count(explode(' ', $order->customer_name)) > 1 ? explode(' ', $order->customer_name)[1] : '') ?? '',
                    'email' => $order->customer_email
                ]
            ];

            Log::info('Données de transaction FedaPay pour produit:', $transactionData);

            $transaction = Transaction::create($transactionData);

            Log::info('Transaction FedaPay pour produit créée:', ['id' => $transaction->id ?? 'non défini']);

            $order->update(['fedapay_transaction_id' => $transaction->id]);

            return $transaction;
        } catch (\Exception $e) {
            Log::error('Erreur FedaPay produit détaillée: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
