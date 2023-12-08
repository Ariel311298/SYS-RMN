<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'area_nombre', 'area_estado'
    ];

    public $sortable = ['area_nombre', 'area_estado'];

    protected $table = 'area';
    protected $primaryKey = 'area_id';

    public function asignaturas()
    {
        return $this->hasMany('App\Models\Asignatura','area_id');
    } 
}
