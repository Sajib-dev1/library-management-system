<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentmessage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function rel_to_student(){
        return $this->belongsTo(User::class,'auth_id');
    }
}
