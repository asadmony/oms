<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentReturnItem extends Model
{
    use HasFactory;

    public function shipmentReturn()
    {
        return $this->belongsTo(ShipmentReturn::class, 'shipment_return_id');
    }
}
