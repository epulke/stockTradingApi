<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    use HasFactory;

    protected $fillable = ["transaction_type", "stock_symbol", "amount", "stock_price"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
