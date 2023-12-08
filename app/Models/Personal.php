<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Personal extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $fillable = [
        'pers_ncedula', 'pers_npasaporte', 'pers_nombres', 'pers_apellidos', 
        'pers_fec_nac', 'pers_telf_convencional', 'pers_num_celular', 'pers_barrio',
        'pers_direccion', 'pers_nacionalidad', 'pers_genero', 'pers_etnia',
        'pers_email_inst', 'pers_tip_sangre', 'pers_dis_tipo', 'pers_dis_porcentaje',
        'pers_num_car_conadis', 'pers_est_civil', 'pers_nivel', 'pers_foto', 'pers_estado'
    ];

    public $sortable = ['pers_ncedula', 'pers_nombres', 'pers_apellidos', 'pers_estado'];

    protected $table = 'personal';
    protected $primaryKey = 'pers_id';

    protected $dates = ['pers_fec_nac'];

    public static function carbonDatesToAge($toDateFormat)
    {
            $dateOfBirth = "$toDateFormat";
            $dateOfBirthToYear = new \DateTime($dateOfBirth);
            $todaysDate = new \DateTime();

        echo $todaysDate->diff($dateOfBirthToYear)->y;
    }

    public function users()
    {
        return $this->hasMany('App\Models\Users','pers_id');
    }
    
    public function roles()
    {
        return $this->hasMany('App\Models\Users','rol_id');
    } 

    public function ofertas()
    {
        return $this->hasMany('App\Models\Oferta','pers_id');
    } 

    public function mallas()
    {
        return $this->hasMany('App\Models\Malla','pers_id');
    } 

    public function tutorproyectos()
    {
        return $this->hasMany('App\Models\TutorProyecto','pers_id');
    } 
}
