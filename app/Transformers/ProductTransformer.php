<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     * @param Product $product [A product instance]
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'pid' => (int)$product->id,
            'title' => (string)$product->name,
            'details' => (string)$product->description,
            'stock' => (int)$product->quantity,
            'available' => ($product->status === AVAILABLE_PRODUCT),
            'picture' => url("img/{$product->image}"),
            'seller' => (int)$product->seller_id,
            'creationDate' => $product->created_at,
            'lastChangeDate' => $product->updated_at,
            'deletedDate' => isset($product->deleted_at)?(string)$product->deleted_at:null,
        ];
    }
}
