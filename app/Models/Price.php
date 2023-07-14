<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'restaurant_id',
        'size_id',
        'price',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
