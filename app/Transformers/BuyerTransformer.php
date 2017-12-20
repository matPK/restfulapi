<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Buyer;

class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Buyer $buyer
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            'id' => (int)$buyer->id,
            'name' => (string)$buyer->name,
            'email' => (string)$buyer->email,
            'is_verified' => (int)$buyer->verified,
            'created_at' => $buyer->created_at,
            'updated_at' => $buyer->updated_at,
            'deleted_at' => !is_null($buyer->deleted_at) ? (string) $buyer->deleted_at : null,
        ];
    }
}
