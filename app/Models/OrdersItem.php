<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersItem extends Model
{
    use HasFactory;

    public function orderDetails(){
        return $this->belongsTo(Orders::class,'order_id');  
    }

    public function customerDetails(){
        return $this->belongsTo(User::class,'user_id');  
    }
    
    public function productDetails(){
        return $this->belongsTo(SubCategories::class,'product_id');  
    }

}

