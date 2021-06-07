<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesList extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name','description'];

    public function items()
    {
        return $this->hasMany(EcommerceSalesListProduct::class, 'sales_list_id');
    }

    public function products()
    {
        return $this->hasManyThrough(EcommerceProduct::class, EcommerceSalesListProduct::class, 'sales_list_id', 'id', 'id', 'product_id');
    }
}
