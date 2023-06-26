<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cancelled', 'created_at', 'updated_at'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}