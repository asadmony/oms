<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommerceSalesListProduct extends Model
{
    use HasFactory;

    public function salesList()
    {
        return $this->belongsTo(SalesList::class, 'sales_list_id');
    }

    public function product()
    {
        return $this->belongsTo(EcommerceProduct::class, 'product_id');
    }
}
