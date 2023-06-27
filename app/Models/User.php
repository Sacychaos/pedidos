<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'is_admin',
        'created_at',
        'updated_at',
        'cancelled',
        'sector_id',
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Set the username attribute and convert it to uppercase before saving.
     */
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtoupper($value);
    }
}