<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Writter extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $guard = 'writter';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    function rel_to_country(){
        return $this->belongsTo(Country::class,'country');
    }

    function rel_to_city(){
        return $this->belongsTo(City::class,'country');
    }
}
