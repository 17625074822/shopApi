<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_id', 'type', 'value', 'status'];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
