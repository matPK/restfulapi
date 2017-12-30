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
            'id' => (int)$category->id,
            'title' => (string)$category->name,
            'details' => (string)$category->description,
            'creationDate' => $category->created_at,
            'lastChangeDate' => $category->updated_at,
            'deletedDate' => isset($category->deleted_at)?(string)$category->deleted_at:null,
        ];
    }
}
