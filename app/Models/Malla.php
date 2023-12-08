<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Http\Controllers\Controller;


class Malla extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'ofer_id', 'pers_id', 'asig_id', 'mal_estado'
    ];

    public $sortable = ['mal_estado'];

    protected $table = 'malla';
    protected $primaryKey = 'mal_id';

    public function oferta()
    {
        return $this->belongsTo('App\Models\Oferta','ofer_id');     
    }    

    public function asignatura()
    {
        return $this->belongsTo('App\Models\Asignatura','asig_id');     
    }
    
    public function personal()
    {
        return $this->belongsTo('App\Models\Personal','pers_id');     
    }

    public function calificaciones()
    {
        return $this->hasMany('App\Models\Calificacion','mal_id');
    } 
}
