<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'created_at', 'cancelled', 'updated_at'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function prices()
    {
    return $this->hasMany(Price::class);
    }

}