<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    public function customerDetails(){
        return $this->belongsTo(User::class,'user_id');  
    }
    
    public function transationDetails(){
        return $this->belongsTo(Transation::class,'transation_id');  
    }
    public function chefDetails(){
        return $this->belongsTo(User::class,'assign_chef_id');  
    }
}
