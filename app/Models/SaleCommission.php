<?php

namespace App\Models;

use App\Models\Ecommerce\EcommerceProduct;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\Role\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleCommission extends Model
{
    use HasFactory;

    
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
    
    public function source()
    {
        return $this->belongsTo(EcommerceSource::class, 'source_id');
    }
    
    public function product()
    {
        return $this->belongsTo(EcommerceProduct::class, 'product_id');
    }



}
