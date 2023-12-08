<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'ofer_id', 'alum_id', 'mat_estado'
    ];

    protected $table = 'matricula';
    protected $primaryKey = 'mat_id';

    public function alumno()
    {
        return $this->belongsTo('App\Models\Alumno','alum_id');     
    }

    public function oferta()
    {
        return $this->belongsTo('App\Models\Oferta','ofer_id');     
    }

    public function calificaciones()
    {
        return $this->hasMany('App\Models\Calificacion','mat_id');
    } 

    public function comportamientos()
    {
        return $this->hasMany('App\Models\Comportamiento','mat_id');
    }
    
    public function proyescolares()
    {
        return $this->hasMany('App\Models\ProyEscolar','mat_id');
    } 
}
