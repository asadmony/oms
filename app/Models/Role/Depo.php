<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depo extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name','address'];

    public function user()
	{
	    return $this->belongsTo('App\Models\User', 'user_id')->withoutGlobalScopes();
	}

	public function division()
	{
		return $this->belongsTo('App\Models\Location\Division', 'division_id');
	}

	public function distributors()
	{
		return $this->hasMany('App\Models\Role\Distributor', 'depo_id');
	}

	public function roleToPayments()
    {
        return $this->morphMany('App\Models\Role\RolePayment', 'roleto');
    }

    public function roleByPayments()
    {
        return $this->morphMany('App\Models\Role\RolePayment', 'roleby');
    }

    public function lastSystemBalanceReceived()
    {
    	return $this->roleToPayments()->where('payment_type', 'system_balance')->latest()->first();
    }

    public function lastSentToSystemBalance()
    {
    	return $this->roleByPayments()->where('payment_type', 'depo_balance')->latest()->first();
    }
}
