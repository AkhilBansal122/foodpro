<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryRequest extends Model
{
    use HasFactory;
    protected  $table = "inventories_requests";
   
    public function productDetails(){
        return   $this->belongsTo(Product::class,'product_id');
       }
    public function userDetails(){
    return   $this->belongsTo(User::class,'user_id');
    }
}
