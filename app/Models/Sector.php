<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cancelled', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}