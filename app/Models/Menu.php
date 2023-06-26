<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'restaurant_id', 'created_at', 'updated_at'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function menuOptions()
    {
        return $this->hasMany(MenuOption::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}