<?php

namespace App\Models;

use App\Models\Role\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SrSalary extends Model
{
    use HasFactory;

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}
