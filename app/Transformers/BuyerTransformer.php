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
            'buyer_id' => (int)$buyer->id,
            'name' => (string)$buyer->name,
            'email' => (string)$buyer->email,
            'is_verified' => ((int)$buyer->verified === 1),
            'creation_date' => (string)$buyer->created_at,
            'last_change_date' => (string)$buyer->updated_at,
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
            'buyer_id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'is_verified' => 'verified',
            'creation_date' => 'created_at',
            'last_change_date' => 'updated_at',
        ];
        return isset($attributes[$index])?$attributes[$index]:null;
    }
}
