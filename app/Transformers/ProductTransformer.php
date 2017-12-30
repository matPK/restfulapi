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
            'available' => ($product->status === Product::AVAILABLE_PRODUCT),
            'picture_url' => url("img/{$product->image}"),
            'seller' => (int)$product->seller_id,
            'creation_date' => (string)$product->created_at,
            'last_change_date' => (string)$product->updated_at,
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
            'pid' => 'id',
            'title' => 'name',
            'details' => 'description',
            'stock' => 'quantity',
            'available' => 'status',
            'picture_url' => 'image',
            'seller' => 'seller_id',
            'creation_date' => 'created_at',
            'last_change_date' => 'updated_at',
        ];
        return isset($attributes[$index])?$attributes[$index]:null;
    }
}
