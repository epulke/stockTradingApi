<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFunds extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "funds"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
