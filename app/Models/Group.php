<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'group_id', 'id');
    }
}
