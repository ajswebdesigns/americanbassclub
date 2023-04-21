<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// New use
use App\Models\Tournament;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'tournament_cat';
    public $timestamps = false;
    
    // New Relationship
    
    // public function tournament(){
    //     return $this->hasMany(Tournament::class, 'tournament_cat_id', 'cat_id');
    // }


}
