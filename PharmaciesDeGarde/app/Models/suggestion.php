<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class suggestion extends Model
{
    protected $primaryKey= 'idSuggestion';
    
    protected $attributes = [
        'status' => 'Pending',
    ];
    function user(){
        return $this->belongsTo(User::class);
    }
    
    use HasFactory;
    
}
