<?php

namespace App;

use App\Product;
use App\Transformers\CategoryTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed products
 * @property int id
 * @property mixed deleted_at
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed name
 * @property mixed description
 */
class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'description',
    ];
    protected $hidden = [
        'deleted_at',
        'pivot',
    ];
    public $transformer = CategoryTransformer::class;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
