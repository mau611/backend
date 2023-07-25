<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;
    protected $fillable = ['observacion', 'fecha' , 'diagnostico_id'];

    public function diagnostico(){
        return $this->belongsTo(Diagnostico::class);
    }
}
