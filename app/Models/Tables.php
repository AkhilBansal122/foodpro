<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function get_restaurent(){
        return $this->belongsTo(User::class,'restaurent_id');
    }
    public function get_manager(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function get_branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
}
