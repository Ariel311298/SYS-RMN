<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comportamiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'ofer_id', 'mat_id', 'cond_notaQ1', 'cond_escalaQ1', 'cond_notaQ2',
        'cond_escalaQ2', 'cond_notaAnual', 'cond_escalaAnual', 'cond_estado'
    ];

    protected $table = 'comportamiento';
    protected $primaryKey = 'cond_id';

    public function oferta()
    {
        return $this->belongsTo('App\Models\Oferta','ofer_id');     
    }   

    public function matricula()
    {
        return $this->belongsTo('App\Models\Matricula','mat_id');     
    }   
}
