<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsignSeat extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = ['id'];

    function rel_to_user(){
        return $this->BelongsTo(User::class,'student_id');
    }

    function rel_to_set(){
        return $this->belongsTo(Seat::class,'seat_id');
    }
}
