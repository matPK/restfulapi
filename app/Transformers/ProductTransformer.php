<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Product $product
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => (int)$product->id,
            'title' => (string)$product->name,
            'details' => (string)$product->description,
            'stock' => (int)$product->quantity,
            'situation' => (string)$product->status,
            'picture' => url("img/{$product->image}"),
            'seller' => (int)$product->seller_id,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
            'deleted_at' => !is_null($product->deleted_at) ? (string) $product->deleted_at : null,
        ];
    }
}
