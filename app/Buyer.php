<?php

namespace App;

use App\Scopes\BuyerScope;

/**
 * @property mixed transactions
 */
class Buyer extends User
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BuyerScope());
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
