<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PadreApoderado extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'alum_id', 'pad_ncedula', 'pad_npasaporte', 'pad_nombres', 'pad_apellidos', 
        'pad_nacionalidad', 'pad_email', 'pad_ocupacion', 'pad_nivel', 'pad_direccion', 
        'pad_telf_celular', 'pad_telf_convencional', 'pad_fec_nac', 'pad_parentesco', 
        'pad_estado'
    ];

    protected $table = 'padre_apoderado';
    protected $primaryKey = 'pad_id';
    
    protected $dates = ['pad_fec_nac'];
    public $sortable = ['pad_apellidos', 'pad_parentesco', 'pad_estado'];

    public static function carbonDatesToAge($toDateFormat)
    {
            $dateOfBirth = "$toDateFormat";
            $dateOfBirthToYear = new \DateTime($dateOfBirth);
            $todaysDate = new \DateTime();

        echo $todaysDate->diff($dateOfBirthToYear)->y;
    }

    public function alumno()
    {
        return $this->belongsTo('App\Models\Alumno','alum_id');     
    }
}
