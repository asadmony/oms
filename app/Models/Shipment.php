<?php

namespace App\Models;

use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommerceOrderPayments;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\Role\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(EcommerceOrder::class, 'order_id');
    }

    public function items()
    {
        return $this->hasMany(ShipmentItem::class, 'shipment_id');
    }
    public function orderByAgent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
    public function orderForUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function orderForSource()
    {
        return $this->belongsTo(EcommerceSource::class, 'source_id');
    }

    public function payment()
    {
        return $this->hasOne(EcommerceOrderPayments::class, 'order_id');
    }
}
