<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use SoftDeletes;

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
