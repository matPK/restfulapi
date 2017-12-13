<?php

namespace App\Http\Controllers\Seller;

use Storage;
use App\User;
use App\Seller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Seller $seller
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $products = $seller->products;
        return $this->showAll($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @param User $seller
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $seller)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image',
        ]);

        $data = $request->all();

        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] = $request->file('image')->store('products');
        $data['seller_id'] = $seller->id;

        $product = Product::create($data);

        return $this->showOne($product, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  \App\Seller $seller
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller, Product $product)
    {
        $rules = [
            'quantity' => 'integer|min:1',
            'status' => 'in:' . Product::AVAILABLE_PRODUCT . ',' . Product::UNAVAILABLE_PRODUCT,
            'image' => 'image',
        ];

        $this->validate($request, $rules);

        $this->checkSeller($seller, $product);

        $product->fill($request->only([
            'name',
            'description',
            'quantity',
        ]));

        if ($request->has('status')) {

            $product->status = $request->status;

            if ($product->isAvailable() && $product->categories()->count() == 0) {
                return $this->errorResponse('An active product must have at least one category', 409);
            }
        }

        if ($request->hasFile('image')) {
            Storage::delete($product->image);
            $product->image = $request->file('image')->store('');
        }

        if ($product->isClean()) {
            return $this->errorResponse('Unprocessable request', 422);
        }

        $product->save();

        return $this->showOne($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller $seller
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller, Product $product)
    {
        $this->checkSeller($seller, $product);

        Storage::delete($product->image);

        $product->delete();
        return $this->deleteResponse();
    }

    protected function checkSeller(Seller $seller, Product $product)
    {
        if ($seller->id != $product->seller_id) {
            throw new HttpException(422, 'The specified seller does not own the product');
        }
    }
}
