<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function agent_info()
    {
        return $this->hasOne(AgentInfo::class, 'agent_id', 'id'); 
    }

       public function payment_details()
       {
           return $this->hasOne(PaymentDetails::class, 'agent_id', 'id'); 
     }
}
