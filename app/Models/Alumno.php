<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Alumno extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'alum_ncedula', 'alum_npasaporte', 'alum_nombres', 'alum_apellidos', 
        'alum_fec_nac', 'alum_barrio', 'alum_genero', 'alum_nacionalidad', 'alum_etnia',
        'alum_dis_tipo', 'alum_dis_porcentaje', 'alum_num_car_conadis', 
        'alum_foto', 'alum_estado'
    ];

    protected $table = 'alumno';
    protected $primaryKey = 'alum_id';

    protected $dates = ['alum_fec_nac'];

    public $sortable = ['alum_ncedula', 'alum_nombres', 'alum_apellidos', 'alum_estado'];

    public static function carbonDatesToAge($toDateFormat)
    {
            $dateOfBirth = "$toDateFormat";
            $dateOfBirthToYear = new \DateTime($dateOfBirth);
            $todaysDate = new \DateTime();

        echo $todaysDate->diff($dateOfBirthToYear)->y;
    }

    public function users()
    {
        return $this->hasMany('App\Models\Users','alum_id');
    }

    public function matriculas()
    {
        return $this->hasMany('App\Models\Matricula','alum_id');
    }
    
    public function padresapoderados()
    {
        return $this->hasMany('App\Models\PadreApoderado','alum_id');
    }
    
    public function roles()
    {
        return $this->hasMany('App\Models\Users','rol_id');
    } 
}
