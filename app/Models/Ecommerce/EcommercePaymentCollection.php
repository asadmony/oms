<?php

namespace App\Models\Ecommerce;

use App\Models\Role\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommercePaymentCollection extends Model
{
    use HasFactory;


    public function source()
    {
        return $this->belongsTo(EcommerceSource::class, 'source_id');
    }
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}
