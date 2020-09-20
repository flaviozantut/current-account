<?php

namespace App\Models;

class Transaction extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'value',
        'payer_id',
        'payee_id',
    ];

    protected $hidden = [
        'payer_id',
        'payee_id',
    ];

    protected $with = ['payer', 'payee'];

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id', 'id');
    }

    public function payee()
    {
        return $this->belongsTo(User::class, 'payee_id', 'id');
    }
}
