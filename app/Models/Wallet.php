<?php

namespace App\Models;

/**
 * @property Owner $owner
 * @property float $amount
 */
class Wallet extends Model
{
    const CREATED_AT = null;

    protected $primaryKey = 'owner_id';

    public $incrementing = false;

    protected $fillable = [
        'amount',
        'owner_id',
    ];

    protected $hidden = ['owner_id', 'updated_at'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
