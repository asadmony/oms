<?php

namespace App\Models;

use App\Models\Ecommerce\EcommerceProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReplacementItem extends Model
{
    use HasFactory;

    public function replacement()
    {
        return $this->belongsTo(ProductReplacement::class, 'product_replacement_id');
    }

    public function product()
    {
        return $this->belongsTo(EcommerceProduct::class, 'product_id');
    }
}
