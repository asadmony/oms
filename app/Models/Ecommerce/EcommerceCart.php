<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommerceCart extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'user_id'];

    public function product()
    {
        return $this->belongsTo(EcommerceProduct::class, 'product_id');
    }
    public function getOrAddCart(EcommerceProduct $product)
    {
        $cart = $product->findCart();
        if (!$cart) {
            $cart = $this->create([
                'product_id' => $product->id,
                'user_id' => auth()->user()->id,
            ]);
        }
        return $cart;
    }
}
