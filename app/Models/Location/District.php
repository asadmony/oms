<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function posts(){
		return $this->belongsToMany('App\Models\Blog', 'post_districts', 'district_id', 'post_id');
	}

  public function thanas()
	{
		return $this->hasMany('App\Models\Location\Upazila','district_id');
	}

	public function division(){
		return $this->belongsTo('App\Models\Location\Division', 'division_id');
	}

	public function hasPost($post){
		$row = $this->posts()->where('posts.id',$post->id)->first();
		if($row){
			return true;
		}
		return false;
	}

	public function getLocaleNameAttribute()
    {

        if(app()->getLocale() == 'bn')
        {
            return $this->bn_name ?: $this->name;

        }else
        {
            return $this->name ?: $this->bn_name;
        }
    }

    public function ecommerceProducts()
    {
    	return $this->hasMany('App\Models\Ecommerce\EcommerceProduct')->live();
    }
}
