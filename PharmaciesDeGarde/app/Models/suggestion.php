<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class suggestion extends Model
{
    use HasFactory;
    function user(){
        return $this->belongsTo(User::class);
    }
}
