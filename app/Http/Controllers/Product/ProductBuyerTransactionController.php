<?php

namespace App\Http\Controllers\Product;

use App\Product;
use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|\Illuminate\Http\Request $request
     * @param Product $product
     * @param User $buyer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $buyer)
    {

        $rules = [
            'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request, $rules);

        if ($buyer->id == $product->seller_id) {
            return $this->errorResponse('The buyer cannot be the seller', 409);
        }

        if (!$buyer->isVerified()) {
            return $this->errorResponse('The buyer must be a verified user', 409);
        }

        if (!$product->seller->isVerified()) {
            return $this->errorResponse('The seller must be a verified user', 409);
        }

        if (!$product->isAvailable()) {
            return $this->errorResponse('The product is not available', 409);
        }

        if ($product->quantity < $request->input('quantity')) {
            return $this->errorResponse('There is not enough products', 409);
        }

        return DB::transaction(function() use ($request, $product, $buyer) {
            $product->quantity -= $request->input('quantity');
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->input('quantity'),
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);

            return $this->showOne($transaction);
        });
    }
}
