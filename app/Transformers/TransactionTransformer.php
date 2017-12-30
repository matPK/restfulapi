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
            'id' => (int)$transaction->id,
            'quantity' => (int)$transaction->quantity,
            'buyer' => (int)$transaction->buyer_id,
            'product' => (int)$transaction->product_id,
            'creationDate' => $transaction->created_at,
            'lastChangeDate' => $transaction->updated_at,
            'deletedDate' => isset($transaction->deleted_at)?(string)$transaction->deleted_at:null,
        ];
    }
}
