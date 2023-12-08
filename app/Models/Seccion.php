<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'sec_id', 'sec_nombre', 'sec_estado'
    ];

    protected $table = 'seccion';
    protected $primaryKey = 'sec_id';

    public function cursos()
    {
        return $this->hasMany('App\Models\Curso','sec_id');
    } 
}
