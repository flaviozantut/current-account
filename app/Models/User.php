<?php

namespace App\Models;

/**
 * @property Wallet $wallet
 * @property string $type
 */
class User extends Model
{
    const commomType = 'commom';
    const shopkeeperType = 'shopkeeper';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'full_name',
        'email',
        'document_id',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['wallet'];

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'owner_id');
    }

    public function benefits()
    {
        return $this->hasMany(Transaction::class, 'payee_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Transaction::class, 'payer_id', 'id');
    }

    public function isCommomType()
    {
        return $this->type === self::commomType;
    }

    public function isShopkeeperType()
    {
        return $this->type === self::shopkeeperType;
    }

    /**
     * Usuários podem enviar dinheiro (efetuar transferência) para lojistas e entre usuários.
     * Lojistas só recebem transferências, não enviam dinheiro para ninguém.
     */
    public function canTransfer(): bool
    {
        return $this->isCommomType();
    }

    public function checkBalanceTo(float $value): bool
    {
        return $value <= $this->wallet->amount;
    }
}
