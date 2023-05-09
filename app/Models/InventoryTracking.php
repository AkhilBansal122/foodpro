<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTracking extends Model
{
    use HasFactory;
    public function productDetails(){
        return   $this->belongsTo(Product::class,'product_id');
    }
 
    public function inventoryDetails(){
        return   $this->belongsTo(Inventory::class,'inventory_id');
    }

}