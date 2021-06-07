<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommerceCatProduct extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(EcommerceCategory::class, 'category_id');
    }
    public function product()
    {
        return $this->belongsTo(EcommerceProduct::class, 'product_id');
    }
}
