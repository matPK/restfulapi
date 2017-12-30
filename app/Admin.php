<?php

namespace App;

use App\Scopes\AdminScope;
use App\Transformers\AdminTransformer;

class Admin extends User
{

    public $transformer = AdminTransformer::class;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new AdminScope());
    }
    //
}
