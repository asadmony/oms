<?php

namespace App\Models\Location;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Market extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name','address'];

    public function division()
	{
		return $this->belongsTo('App\Models\Location\Division', 'division_id');
	}

	public function district()
	{
		return $this->belongsTo('App\Models\Location\District', 'district_id');
	}

	public function upazila()
	{
		return $this->belongsTo('App\Models\Location\Upazila', 'upazila_id');
	}

    public function dealer()
    {
        return $this->belongsTo('App\Models\Role\Dealer', 'dealer_id');
    }

    public function agent()
    {
    	return $this->belongsTo('App\Models\Role\Agent', 'agent_id');
    }

    public function sources()
    {
    	return $this->hasMany('App\Models\Source');
    }
}
