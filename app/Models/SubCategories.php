<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;

    public function menuDetails(){
        return $this->belongsTo(Category::class,'category_id');  
    }

    public function restaurentDetails(){
        return $this->belongsTo(User::class,'user_id');  
    }
    
}

