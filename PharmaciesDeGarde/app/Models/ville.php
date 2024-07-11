<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ville extends Model
{ 
    protected $primaryKey= 'idVille';
    public function pharmacies(){
        return $this->hasMany(pharmacie::class);

    }
    use HasFactory;
}
