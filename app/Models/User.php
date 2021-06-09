<?php

namespace App\Models;

use App\Models\Ecommerce\EcommerceCart;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\Role\Agent;
use App\Models\Role\Depo;
use App\Models\Role\Distributor;
use App\Scopes\ActiveScope;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_temp',
        'mobile',
        'mobile_country',
        'username',
        'calling_code',
        'currency_code',
        'nid',
        'addedby_type',
        'addedby_id',
        'editedby_id',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
    ];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
        //'active = 1'
    }

    public function mobileOrEmail()
    {
        return $this->mobile ?: $this->email;
    }


    //passport

    public function findForPassport($username)
    {
        return $this->where('mobile', $username)->first();
    }

    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }


    //passport end



//old from msbd/epl/bravo
    public function myroles()
    {
        return $this->hasMany('App\Models\Role\MyRole', 'user_id');
    }



    public function isAdmin()
    {

        if($this->myroles()->where('role_name', 'admin')->first())
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function isCommonAdmin()
    {

        if($this->myroles()->where('role_name', 'common')->first())
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function isFactory()
    {

        if($this->myroles()->where('role_name', 'factory')->first())
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function isMember()
    {

        if($this->memberAccount)
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function hasMyRole($role) //$role = admin, staff..
    {


        if($role == 'admin' || $role == 'factory')
        {
           if($this->myroles()->where('role_name', $role)->first())
            {
                return true;
            }
            else{
                return false;
            }
        }

        elseif($role == 'dealer')
        {
            return (bool) $this->dealers()->count();
        }

        elseif($role == 'agent')
        {
            return (bool) $this->agents()->count();
        }


    }

    public function agents()
    {
        return $this->hasMany('App\Models\Role\Agent', 'user_id');
    }

    public function hasAgentRole()
    {
        return (bool) $this->agents()->count();
    }

    public function hasAgentOf($agent)
    {
        return (bool) $this->agents()
        ->whereId($agent->id)
        ->whereActive(true)
        ->first();
    }

    public function dealers()
    {
        return $this->hasMany('App\Models\Role\Dealer', 'user_id');
    }

    public function hasDealerRole()
    {
        return (bool) $this->dealers()->count();
    }

    public function hasDealerOf($dealer)
    {
         return (bool) $this->dealers()
        ->whereId($dealer->id)
        ->whereActive(true)
        ->first();
    }


    //role end


    //ecommerce
    public function sources()
    {
        return $this->hasMany(EcommerceSource::class, 'user_id');
    }

    public function ecommerceCarts()
    {
        return $this->hasMany(EcommerceCart::class, 'user_id')->with('product');
    }

    public function ecommerceOrders()
    {
        return $this->hasMany(EcommerceOrder::class, 'user_id')->with('items');
    }
    public function fetchOrCreateTempOrder()
    {
        $order = $this->ecommerceOrders()->where('order_status', 'temp')->first();
        if (!$order) {
            $order = new EcommerceOrder;
            $order->user_id = auth()->user()->id;
            $order->order_status = 'temp';
            $order->save();
        }
        return $order;
    }
    public function getMyOrders($paginate)
    {
        return $this->ecommerceOrders()->where('order_status','<>', 'temp')->paginate($paginate);
    }

    public function distributors()
    {
        return $this->hasMany(Distributor::class, 'user_id');
    }

    public function depos()
    {
        return $this->hasMany(Depo::class, 'user_id');
    }

    public function addedby()
    {
        return $this->morphTo();
    }

    public function createdUsers()
    {
        return $this->morphMany(User::class, 'addedby');
    }

    public function srLocations()
    {
        return $this->hasMany(SrLocation::class, 'user_id');
    }
}
