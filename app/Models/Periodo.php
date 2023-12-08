<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Periodo extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'per_nombre', 'per_fec_inicio', 'per_fec_fin', 'per_estado'
    ];

    protected $table = 'periodo';
    protected $primaryKey = 'per_id';

    protected $dates = ['per_fec_inicio','per_fec_fin'];
  
    public $sortable = ['per_nombre', 'per_fec_inicio', 'per_fec_fin', 'per_estado'];

    public function ofertas()
    {
        return $this->hasMany('App\Models\Oferta','per_id');
    }
}
