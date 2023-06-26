<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuOption extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'option_id', 'created_at', 'updated_at'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}