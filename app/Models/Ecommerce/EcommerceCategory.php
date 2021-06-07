<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;

class EcommerceCategory extends Model
{
    use HasFactory;
    use HasTranslations;
    use NodeTrait;

    public $translatable = ['name','description'];

    protected $fillable = [
        'parent_id',
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }


    public function products()
    {
        return $this->hasManyThrough(EcommerceProduct::class, EcommerceCatProduct::class, 'category_id', 'id', 'id', 'product_id');
    }

}
