<?php

namespace App\Http\Controllers\Product;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $categories = $product->categories;
        return $this->showAll($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Category $category)
    {
        $product->categories()->syncWithoutDetaching([$category->id]);
        return $this->showAll($product->categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Category $category)
    {
        $categories = $product->categories();
        if (!$categories->find($category->id)) {
            return $this->errorResponse('This product does not have this category', 404);
        }
        $categories->detach($category->id);
        return $this->deleteResponse();
    }
}
