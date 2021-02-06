<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{
    use HasFactory;

    public function portfolios()
    {
        return $this->belongsTo(Portfolio::class, 'portfolio_id' );
    }
}
