<?php

namespace App\Models;

use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\Role\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReplacement extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(ProductReplacementItem::class, 'product_replacement_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function source()
    {
        return $this->belongsTo(EcommerceSource::class, 'source_id');
    }

    public function order()
    {
        return $this->belongsTo(EcommerceOrder::class, 'order_id');
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }


}
