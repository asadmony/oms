<?php

namespace App\Models;

use App\Models\Ecommerce\EcommerceOrderItem;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\Role\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentItem extends Model
{
    use HasFactory;


    public function orderItem()
    {
        return $this->belongsTo(EcommerceOrderItem::class, 'order_item_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function source()
    {
        return $this->belongsTo(EcommerceSource::class, 'seller_source_id');
    }

    
}
