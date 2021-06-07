<?php

namespace App\Models\Ecommerce;

use App\Models\ShipmentItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EcommerceOrderItem extends Model
{
    use HasFactory;

    use HasTranslations;
    public $translatable = ['product_name'];

    public function order()
    {
        return $this->belongsTo(EcommerceOrder::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(EcommerceProduct::class, 'product_id');
    }
    
    public function shipmentItems()
    {
        return $this->hasMany(ShipmentItem::class, 'order_item_id');
    }
}
