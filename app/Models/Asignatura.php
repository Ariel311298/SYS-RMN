<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Kyslik\ColumnSortable\Sortable;

class Asignatura extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'area_id', 'cur_id', 'asig_nom', 'asig_estado'
    ];

    public $sortable = ['asig_nom', 'asig_estado'];

    protected $table = 'asignatura';
    protected $primaryKey = 'asig_id';

    public function curso()
    {
        return $this->belongsTo('App\Models\Curso','cur_id');     
    }    

    public function area()
    {
        return $this->belongsTo('App\Models\Area','area_id');     
    }    

    public function mallas()
    {
        return $this->hasMany('App\Models\Malla','asig_id');
    } 
}
