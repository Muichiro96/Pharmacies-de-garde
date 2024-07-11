<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pharmacie extends Model
{
    protected $primaryKey= 'idPharmacie';
    public function gardes(){
        return $this->belongsToMany(garde::class,foreignPivotKey:'pharmacie_id',relatedPivotKey: 'garde_id');
    }
    public function ville(){
        return $this->belongsTo(ville::class,'ville_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
