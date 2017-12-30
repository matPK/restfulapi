<?php

namespace App\Transformers;

use App\Category
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     * @param Category $category [A category instance]
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'category_id' => (int)$category->id,
            'title' => (string)$category->name,
            'details' => (string)$category->description,
            'creation_date' => (string)$category->created_at,
            'last_change_date' => (string)$category->updated_at,
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
            'category_id' => 'id',
            'title' => 'name',
            'details' => 'description',
            'creation_date' => 'created_at',
            'last_change_date' => 'updated_at',
        ];
        return isset($attributes[$index])?$attributes[$index]:null;
    }
}
