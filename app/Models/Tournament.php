<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
class Tournament extends Model
{
    use HasFactory;
    
    // New Relationship
    // public function category(){
    //     return $this->belongsTo(Category::class, 'cat_id');
    // }
    
}
