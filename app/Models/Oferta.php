<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Http\Controllers\Controller;

class Oferta extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'per_id', 'cur_id', 'pers_id', 'ofer_estado'
    ];

    protected $table = 'oferta';
    protected $primaryKey = 'ofer_id';

    public $sortable = ['ofer_estado'];

    public function periodo()
    {
        return $this->belongsTo('App\Models\Periodo','per_id');     
    }    

    public function curso()
    {
        return $this->belongsTo('App\Models\Curso','cur_id');     
    }
    
    public function personal()
    {
        return $this->belongsTo('App\Models\Personal','pers_id');     
    }

    public function mallas()
    {
        return $this->hasMany('App\Models\Malla','ofer_id');
    }

    public function matriculas()
    {
        return $this->hasMany('App\Models\Matricula','ofer_id');
    }

    public function comportamientos()
    {
        return $this->hasMany('App\Models\Comportamiento','ofer_id');
    } 

    public function tutorproyectos()
    {
        return $this->hasMany('App\Models\TutorProyecto','ofer_id');
    } 
}
