<?php

namespace App\Transformers;

use App\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     * @param Transaction $transaction [A transaction instance]
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'transaction_id' => (int)$transaction->id,
            'quantity' => (int)$transaction->quantity,
            'buyer' => (int)$transaction->buyer_id,
            'product' => (int)$transaction->product_id,
            'creation_date' => (string)$transaction->created_at,
            'last_change_date' => (string)$transaction->updated_at,
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
            'transaction_id' => 'id',
            'quantity' => 'quantity',
            'buyer' => 'buyer_id',
            'product' => 'product_id',
            'creation_date' => 'created_at',
            'last_change_date' => 'updated_at',
        ];
        return isset($attributes[$index])?$attributes[$index]:null;
    }
}
