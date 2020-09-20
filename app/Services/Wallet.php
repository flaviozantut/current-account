<?php

namespace App\Services;

use App\Authorization\Client;
use App\Events\Transaction as TransactionEvent;
use App\Exceptions\UnauthorizedTransaction;
use App\Models\User as UserModel;
use App\Models\Wallet as WalletModel;
use App\Repositories\Transaction as TransactionRepo;
use App\Repositories\Wallet as WalletRepo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class Wallet extends Service
{
    protected $walletRepo;

    protected $transactionRepo;

    protected $authorizationClient;

    public function __construct(WalletRepo $walletRepo, TransactionRepo $transactionRepo, Client $client)
    {
        $this->walletRepo = $walletRepo;
        $this->transactionRepo = $transactionRepo;
        $this->authorizationClient = $client;
    }

    public function create(UserModel $user, float $amount = 0): WalletModel
    {
        return $this->walletRepo->create([
            'owner_id' => $user->getKey(),
            'amount' => $amount,
        ]);
    }

    public function transaction(UserModel $payer, UserModel $payee, float $value)
    {
        $this->validateTransaction($payer, $payee, $value);

        return DB::transaction(function () use ($payer, $payee, $value) {
            $this->walletRepo->update($payer->getKey(), [
                'amount' => $payer->wallet->amount - $value,
            ]);

            $this->walletRepo->update($payee->getKey(), [
                'amount' => $payee->wallet->amount + $value,
            ]);

            $transaction = $this->transactionRepo->create([
                'payer_id' => $payer->getKey(),
                'payee_id' => $payee->getKey(),
                'value' => $value,
            ]);

            $transaction->setRelation('payer', $payer);
            $transaction->setRelation('payee', $payee);

            Event::dispatch(new TransactionEvent($transaction));

            return $transaction;
        });
    }

    public function addCredit(UserModel $user, float $value)
    {
        throw_if($value <= 0, new UnauthorizedTransaction('Invalid credit value.'));

        $this->walletRepo->update($user->getKey(), [
            'amount' => $user->wallet->amount + $value,
        ]);
    }

    private function validateTransaction(UserModel $payer, UserModel $payee, float $value)
    {
        throw_if($value <= 0, new UnauthorizedTransaction('Invalid transaction value.'));

        throw_if($payer == $payee, new UnauthorizedTransaction('Unauthorized payer and payee its same.'));

        throw_if(!$payer->canTransfer(), new UnauthorizedTransaction('Unauthorized payer transfer.'));

        throw_if(!$payer->checkBalanceTo($value), new UnauthorizedTransaction('Insufficient funds.'));

        throw_if(!$this->authorizationClient->isAuthorized($payer, $payee, $value), new UnauthorizedTransaction('Unauthorized from external service.'));
    }
}
