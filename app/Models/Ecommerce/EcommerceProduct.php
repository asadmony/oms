<?php

namespace App\Models\Ecommerce;

use App\Models\Role\Agent;
use App\Models\SaleCommission;
use App\Models\ShipmentReturnItem;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EcommerceProduct extends Model
{
    use HasFactory;

    use HasTranslations;
    public $translatable = ['name', 'excerpt', 'description', 'what_in_box'];

    public function mediaFiles()
    {
        return $this->hasMany(EcommerceProductMedia::class, 'ecommerce_product_id');
    }

    public function categoryRelations()
    {
        return $this->hasMany(EcommerceCatProduct::class, 'product_id');
    }

    public function categories()
    {
        return $this->hasManyThrough(EcommerceCategory::class, EcommerceCatProduct::class, 'product_id', 'id', 'id', 'category_id');
    }

    public function fetchOrCreateTemp(Agent $agent)
    {
        $me = auth()->user();
        $product = $this->where('status', 'temp')->where('agent_id', $agent->id)->first();

        if (!$product) {
            $this->depo_id = $agent->depo_id;
            $this->distributor_id = $agent->distributor_id;
            $this->dealer_id = $agent->dealer_id;
            $this->agent_id = $agent->id;
            $this->division_id = $agent->division_id;
            $this->district_id = $agent->district_id;
            $this->upazila_id = $agent->upazila_id;
            $this->addedby_id = $me->id;
            $this->editedby_id = $me->id;
            $this->status = 'temp';
            $this->save();

            return $this->load('owner','source','prices','categoryRelations');
        }
        return $product;
    }
    public function getAllProducts($agent, $paginate){
        return $this->where('agent_id', $agent->id)
                ->latest()
                ->with('owner', 'source')
                ->paginate($paginate);
    }
    public function getAllPublishedProducts($paginate){
        return $this->where('status', 'published')
                ->latest()
                ->with('owner', 'source', 'prices')
                ->paginate($paginate);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function source()
    {
        return $this->belongsTo(EcommerceSource::class, 'source_id');
    }

    public function prices()
    {
        return $this->hasMany(EcommerceProductPrice::class, 'product_id');
    }

    public function productsForCustomer()
    {
        return $this->where('status', 'published')->where('b_to_c', 1);
    }

    public function carts()
    {
        return $this->hasMany(EcommerceCart::class, 'product_id');
    }

    public function findCart()
    {
        if (auth()->check()) {
            return auth()->user()->ecommerceCarts()->where('product_id', $this->id)->first();
        }else{
            return null;
        }
        // return $this->carts()->where('user_id', auth()->user()->id)->first();
    }

    public function priceByQuantity($quantity)
    {
        if ($this->prices) {
            $price = $this->prices()->where('min_unit', '<=', $quantity)->orderBy('min_unit', 'desc')->first();
            if ($price) {
                return $price->sale_price;
            }else{
                return $this->sale_price;
            }
        }else{
            return $this->sale_price;
        }
    }

    public function category()
    {
        return $this->belongsTo(EcommerceCategory::class, 'category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(EcommerceOrderItem::class, 'product_id');
    }

    public function shopAmount($sourceId)
    {
        $source = EcommerceSource::find($sourceId);
        $salePrice = $this->sale_price;
        $com = $source->commissionByProduct($this->id);
        $shopAmount = $salePrice - (($salePrice/100)*$com );
        return $shopAmount;
    }

    
    public function sales()
    {
        return $this->hasMany(SaleCommission::class, 'product_id');
    }


    public function returns()
    {
        return $this->hasMany(ShipmentReturnItem::class, 'product_id');
    }
}
