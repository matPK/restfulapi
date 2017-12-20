<?php

namespace App\Transformers;

use App\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Transaction $transaction
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'id' => (int)$transaction->id,
            'quantity' => (string)$transaction->quantity,
            'buyer' => (string)$transaction->buyer_id,
            'product' => (int)$transaction->product_id,
            'created_at' => $transaction->created_at,
            'updated_at' => $transaction->updated_at,
            'deleted_at' => !is_null($transaction->deleted_at) ? (string) $transaction->deleted_at : null,
        ];
    }
}
