<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    public function posts(){
		return $this->belongsToMany('App\Models\Blog', 'post_thanas', 'thana_id', 'post_id');
	}

	public function hasPost($post){
		$row = $this->posts()->where('posts.id',$post->id)->first();
		if($row){
			return true;
		}
		return false;
	}

	public function division(){
		return $this->belongsTo('App\Models\Location\Division', 'division_id');
	}

	public function district(){
		return $this->belongsTo('App\Models\Location\District', 'district_id');
	}

	public function dealer()
	{
		return $this->hasOne('App\Models\Role\Dealer','upazila_id');
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

    public function markets()
    {
    	return $this->hasMany('App\Models\Location\Market');
    }
}
