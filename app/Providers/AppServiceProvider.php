<?php

namespace App\Providers;

use App\Mail\UserMailChanged;
use Mail;
use Schema;
use App\User;
use App\Product;
use App\Mail\UserCreated;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        User::created(function($user) {
            retry(5, function() use ($user) {
                Mail::to($user->email)->send(new UserCreated($user));
            },1000);
        });

        User::updated(function($user) {
            if ($user->isDirty('email')) {
                retry(5, function() use ($user) {
                    Mail::to($user->email)->send(new UserMailChanged($user));
                },1000);
            }
        });

        Product::updated(function(Product $product) {
            if ($product->quantity === 0 && $product->isAvailable()) {
                $product->status = Product::UNAVAILABLE_PRODUCT;
                $product->save();
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
