<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStock extends Model
{
    use HasFactory;

    protected $fillable = ["stock_symbol", "purchase_price", "amount"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
