<?php

namespace App\Models\Role;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MyRole extends Model
{
    use HasFactory;

    protected $fillable = ['role_name', 'role_value', 'nid', 'addedby_id'];

    public function user()
	{
	    return $this->belongsTo('App\Models\User', 'user_id')->withoutGlobalScopes();
	}

	public function addedBy()
	  {
	      return $this->belongsTo('App\Models\User', 'addedby_id')->withoutGlobalScopes();
	  }

	  public function editedBy()
	  {
	      return $this->belongsTo('App\Models\User', 'editedby_id')->withoutGlobalScopes();
	  }

}
