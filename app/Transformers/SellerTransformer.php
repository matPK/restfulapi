<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Seller;

class SellerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Seller $seller
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
            'id' => (int)$seller->id,
            'name' => (string)$seller->name,
            'email' => (string)$seller->email,
            'is_verified' => (int)$seller->verified,
            'created_at' => $seller->created_at,
            'updated_at' => $seller->updated_at,
            'deleted_at' => !is_null($seller->deleted_at) ? (string) $seller->deleted_at : null,
        ];
    }
}
