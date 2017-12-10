<?php

namespace App;

use App\Scopes\SellerScope;

/**
 * @property mixed products
 */
class Seller extends User
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SellerScope());
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
