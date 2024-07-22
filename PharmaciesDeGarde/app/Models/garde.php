<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class garde extends Model
{
    protected $primaryKey= 'idGarde';
    protected $with = ['pharmacies'];
    public function pharmacies(){
        return $this->belongsToMany(pharmacie::class,foreignPivotKey:'garde_id',relatedPivotKey : 'pharmacie_id');
    }
    use HasFactory;
}
