<?php
/**
 * Created by PhpStorm.
 * User: Matheus
 * Date: 26/11/2017
 * Time: 18:56
 */

namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\User;

class AdminScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder
            ->where('admin', User::ADMIN_USER)
            ->where('verified', User::VERIFIED_USER);
    }
}