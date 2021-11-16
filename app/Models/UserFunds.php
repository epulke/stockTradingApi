<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFunds extends Model
{
    use HasFactory;

    protected $fillable = ["funds"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
