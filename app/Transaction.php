<?php

namespace App;

use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property Product product
 * @property Buyer buyer
 * @property mixed id
 * @property mixed quantity
 * @property mixed buyer_id
 * @property mixed product_id
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed deleted_at
 */
class Transaction extends Model
{
    use SoftDeletes;

    public $transformer = TransactionTransformer::class;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id',
    ];
    protected $hidden = [
        'deleted_at',
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
