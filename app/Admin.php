<?php

namespace App;

use App\Scopes\AdminScope;

class Admin extends User
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new AdminScope());
    }
    //
}
