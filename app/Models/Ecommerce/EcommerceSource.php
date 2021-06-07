<?php

namespace App\Models\Ecommerce;

use App\Models\Role\Agent;
use App\Models\ShipmentReturn;
use App\Models\ShopCommission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EcommerceSource extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name', 'slogan', 'description', 'address'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function ecommerceProducts()
    {
        return $this->hasMany(EcommerceProduct::class, 'source_id');
    }

    public function commissions()
    {
        return $this->hasMany(ShopCommission::class, 'source_id');
    }

    public function commissionByProduct($productId)
    {
        $product = EcommerceProduct::find($productId);
        
        $commission = $this->commissions()->where('category_id', $product->category_id)->pluck('commission')->first();
        if (!$commission) {
            $commission = $product->category->shop_commission;
        }
        return $commission;
    }

    public function orders()
    {
        return $this->hasMany(EcommerceOrder::class, 'source_id');
    }
    public function collections()
    {
        return $this->hasMany(EcommercePaymentCollection::class, 'source_id');
    }
    public function returns()
    {
        return $this->hasMany(ShipmentReturn::class, 'source_id');
    }

    public function orderCount()
    {
        return $this->orders()->count();
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}
