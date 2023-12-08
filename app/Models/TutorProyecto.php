<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorProyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'pers_id', 'ofer_id', 'tutproy_estado'
    ];

    protected $table = 'tutor_proyecto';
    protected $primaryKey = 'tutproy_id';

    public function personal()
    {
        return $this->belongsTo('App\Models\Personal','pers_id');     
    }

    public function oferta()
    {
        return $this->belongsTo('App\Models\Oferta','ofer_id');     
    }

    public function proyescolares()
    {
        return $this->hasMany('App\Models\ProyEscolar','tutproy_id');
    } 
}
