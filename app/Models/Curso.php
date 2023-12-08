<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Curso extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'sec_id', 'cur_nivel', 'cur_nombre', 'cur_paralelo', 'cur_estado'
    ];

    protected $table = 'curso';
    protected $primaryKey = 'cur_id';
    
    public $sortable = ['sec_id', 'cur_nivel', 'cur_nombre', 'cur_paralelo', 'cur_estado'];

    public function seccion()
    {
        return $this->belongsTo('App\Models\Seccion','sec_id');     
    }    

    public function asignaturas()
    {
        return $this->hasMany('App\Models\Asignatura','cur_id');
    } 

    public function ofertas()
    {
        return $this->hasMany('App\Models\Oferta','cur_id');
    } 
}
