<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    public function screenshots(){
        return $this->hasMany(Screenshot::class, 'portfolio_id', 'id');
    }
    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
