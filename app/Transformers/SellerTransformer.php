<?php

namespace App\Transformers;

use App\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     * @param Seller $seller [A seller instance]
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
            'uid' => (int)$seller->id,
            'name' => (string)$seller->name,
            'email' => (string)$seller->email,
            'isVerified' => ((int)$seller->verified === 1),
            'creationDate' => $seller->created_at,
            'lastChangeDate' => $seller->updated_at,
            'deletedDate' => isset($seller->deleted_at)?(string)$seller->deleted_at:null,
        ];
    }
}
