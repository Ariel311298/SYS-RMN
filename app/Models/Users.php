<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'rol_id',
        'alum_id',
        'pers_id',
        'name',
        'email',
        'password',
        'usu_estado'
    ];

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $sortable = ['rol_id', 'name', 'email', 'usu_estado'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }

    public function rol()
    {
        return $this->belongsTo('App\Models\Rol','rol_id');     
    }    

    public function personal()
    {
        return $this->belongsTo('App\Models\Personal','pers_id');     
    }  
    
    public function alumno()
    {
        return $this->belongsTo('App\Models\Alumno','alum_id','alum_id');     
    }  
}
