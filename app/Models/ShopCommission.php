<?php

namespace App\Models;

use App\Models\Ecommerce\EcommerceCategory;
use App\Models\Ecommerce\EcommerceSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCommission extends Model
{
    use HasFactory;

    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shop()
    {
        return $this->belongsTo(EcommerceSource::class, 'source_id');
    }

    public function category()
    {
        return $this->belongsTo(EcommerceCategory::class, 'category_id');
    }

    
}
