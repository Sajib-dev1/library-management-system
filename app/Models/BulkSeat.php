<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkSeat extends Model
{
    use HasFactory;

    function rel_to_shift(){
        return $this->belongsTo(Shift::class,'shift_id');
    }
}
