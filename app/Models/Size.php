<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cancelled', 'created_at', 'updated_at'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

}