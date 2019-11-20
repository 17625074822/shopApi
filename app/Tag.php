<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['product_id', 'type', 'value', 'status'];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
