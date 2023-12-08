<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $fillable = [
        'rol_id', 'rol_nombre', 'rol_abrev', 'rol_estado'
    ];

    protected $table = 'rol';
    protected $primaryKey = 'rol_id';

    public function users()
    {
        return $this->hasMany('App\Models\Users','rol_id');
    } 
}
