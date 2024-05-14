<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function rel_to_asign_seat(){
        return $this->belongsTo(AsignSeat::class,'id');
    }

    function rel_to_user(){
        return $this->belongsTo(User::class,'student_id');
    }

    function rel_to_shift(){
        return $this->belongsTo(Shift::class,'shift_id');
    }

    function rel_to_asign(){
        return $this->belongsTo(AsignSeat::class,'asign_id');
    }

    function rel_to_bulk_seat(){
        return $this->belongsTo(BulkSeat::class,'shift_id');
    }
}
