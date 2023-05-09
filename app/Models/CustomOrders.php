<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrders extends Model
{
    use HasFactory;
    
    public function categoryDetails(){
        return $this->belongsTo(Category::class,'category_id');  
    }

    public function menuDetails(){
        return $this->belongsTo(SubCategories::class,'sub_category_id');  
    }
}