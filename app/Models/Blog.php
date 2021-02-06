<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
}
