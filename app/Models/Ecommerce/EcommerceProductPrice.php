<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommerceProductPrice extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(EcommerceProduct::class, 'product_id');
    }
}
