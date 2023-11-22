<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotosControl extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'consulta_id'];
    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
