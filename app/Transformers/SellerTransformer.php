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
            'seller_id' => (int)$seller->id,
            'name' => (string)$seller->name,
            'email' => (string)$seller->email,
            'is_verified' => ((int)$seller->verified === 1),
            'creation_date' => (string)$seller->created_at,
            'last_change_date' => (string)$seller->updated_at,
        ];
    }

    /**
     * Obtains the original attribute.
     * @param string $index [the transformed attribute name]
     * @return mixed
     */
    public static function originalAttribute($index)
    {
        $attributes = [
            'seller_id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'is_verified' => 'verified',
            'creation_date' => 'created_at',
            'last_change_date' => 'updated_at',
        ];
        return isset($attributes[$index])?$attributes[$index]:null;
    }
}
