<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
 	public function posts(){
		return $this->belongsToMany('App\Models\Blog', 'post_divisions', 'division_id', 'post_id');
	}

	public function hasPost($post){
		$row = $this->posts()->where('blogs.id',$post->id)->first();
		if($row){
			return true;
		}
		return false;
	}

	public function districts()
	{
		return $this->hasMany('App\Models\Location\District','division_id');
	}

	public function thanas()
	{
		return $this->hasMany('App\Models\Location\Upazila','division_id');
	}

	public function depots()
	{
		return $this->hasMany('App\Models\Role\Depot');
	}

	public function distributors()
	{
		return $this->hasMany('App\Models\Role\Distributor');
	}

	public function dealers()
	{
		return $this->hasMany('App\Models\Role\Dealer');
	}

	public function agents()
	{
		return $this->hasMany('App\Models\Role\Agent');
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

    public function leads()
    {
    	return $this->hasMany('App\Models\Lead')->live();
    }
}
