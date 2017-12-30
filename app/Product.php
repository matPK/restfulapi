<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed categories
 * @property mixed transactions
 * @property Seller seller
 * @property string status
 * @property int seller_id
 * @property int quantity
 * @property int id
 * @property string image
 */
class Product extends Model
{
    use SoftDeletes;

    public const AVAILABLE_PRODUCT = 'available';
    public const UNAVAILABLE_PRODUCT = 'unavailable';
    public $transformer = ProductTransformer::class;

    protected $dates = ['deleted_at'];
    protected $hidden = [
        'deleted_at',
        'pivot',
    ];

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id',
    ];

    public function isAvailable()
    {
        return $this->status == Product::AVAILABLE_PRODUCT;
    }

    public function setQuantityAttribute($quantity)
    {
        $this->attributes['quantity'] = (integer) $quantity;
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
