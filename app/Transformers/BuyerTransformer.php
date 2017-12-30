<?php

namespace App\Transformers;

use App\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     * @param Buyer $buyer [A buyer instance]
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            'uid' => (int)$buyer->id,
            'name' => (string)$buyer->name,
            'email' => (string)$buyer->email,
            'isVerified' => ((int)$buyer->verified === 1),
            'creationDate' => $buyer->created_at,
            'lastChangeDate' => $buyer->updated_at,
            'deletedDate' => isset($buyer->deleted_at)?(string)$buyer->deleted_at:null,
        ];
    }
}
