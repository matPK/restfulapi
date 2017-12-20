<?php

namespace App\Transformers;

use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Category $category
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id' => (int)$category->id,
            'title' => (string)$category->name,
            'details' => (string)$category->description,
            'created_at' => $category->created_at,
            'updated_at' => $category->updated_at,
            'deleted_at' => !is_null($category->deleted_at) ? (string) $category->deleted_at : null,
        ];
    }
}
