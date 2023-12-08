<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyEscolar extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutproy_id', 'mat_id', 'proy_prom_parcialP1Q1', 'proy_prom_parcialP2Q1', 'proy_promTotalQ1',
        'proy_prom_parcialP1Q2', 'proy_prom_parcialP2Q2', 'proy_promTotalQ2', 'proy_estado'
    ];

    protected $table = 'proy_escolar';
    protected $primaryKey = 'proy_id';

    public function tutorproyecto()
    {
        return $this->belongsTo('App\Models\TutorProyecto','tutproy_id');     
    }   

    public function matricula()
    {
        return $this->belongsTo('App\Models\Matricula','mat_id');     
    }   
}
