<?php

namespace App\Models;

use App\Models\Ecommerce\EcommerceCategory;
use App\Models\Role\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SrCommission extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sr()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function category()
    {
        return $this->belongsTo(EcommerceCategory::class, 'category_id');
    }
}
