<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'mal_id', 'mat_id', 'cal_deberP1Q1', 'cal_actindP1Q1', 'cal_actgruP1Q1',
        'cal_lecP1Q1', 'cal_pruP1Q1', 'cal_promP1Q1', 'cal_deberP2Q1', 'cal_actindP2Q1',
        'cal_actgruP2Q1', 'cal_lecP2Q1', 'cal_pruP2Q1', 'cal_promP2Q1', 'cal_promParQ1',
        'cal_promQ1_80', 'cal_examQ1_10', 'cal_examQ1_20', 'cal_promTotalQ1', 'cal_escalaQ1',
        'cal_deberP1Q2', 'cal_actindP1Q2', 'cal_actgruP1Q2', 'cal_lecP1Q2', 'cal_pruP1Q2',
        'cal_promP1Q2', 'cal_deberP2Q2', 'cal_actindP2Q2', 'cal_actgruP2Q2', 'cal_lecP2Q2',
        'cal_pruP2Q2', 'cal_promP2Q2', 'cal_promParQ2', 'cal_promQ2_80', 'cal_examQ2_10',
        'cal_examQ2_20', 'cal_promTotalQ2', 'cal_escalaQ2', 'cal_promAnual', 'cal_escalaAnual',
        'cal_estatus', 'cal_examMejora', 'cal_examSupletorio', 'cal_examRemedial', 'cal_examGracia',
        'cal_estado'
    ];

    protected $table = 'calificacion';
    protected $primaryKey = 'cal_id';

    protected $casts = [
        'cal_deberP1Q1' => 'decimal:2',
        'cal_actindP1Q1' => 'decimal:2',
        'cal_actgruP1Q1' => 'decimal:2',
        'cal_lecP1Q1' => 'decimal:2',
        'cal_pruP1Q1' => 'decimal:2',
        'cal_promP1Q1' => 'decimal:2',
        'cal_deberP2Q1' => 'decimal:2',
        'cal_actindP2Q1' => 'decimal:2',
        'cal_actgruP2Q1' => 'decimal:2',
        'cal_lecP2Q1' => 'decimal:2',
        'cal_pruP2Q1' => 'decimal:2',
        'cal_promP2Q1' => 'decimal:2',
        'cal_promParQ1' => 'decimal:2',
        'cal_promQ1_80' => 'decimal:2',
        'cal_examQ1_10' => 'decimal:2',
        'cal_examQ1_20' => 'decimal:2',
        'cal_promTotalQ1' => 'decimal:2',
        'cal_deberP1Q2' => 'decimal:2',
        'cal_actindP1Q2' => 'decimal:2',
        'cal_actgruP1Q2' => 'decimal:2',
        'cal_lecP1Q2' => 'decimal:2',
        'cal_pruP1Q2' => 'decimal:2',
        'cal_promP1Q2' => 'decimal:2',
        'cal_deberP2Q2' => 'decimal:2',
        'cal_actindP2Q2' => 'decimal:2',
        'cal_actgruP2Q2' => 'decimal:2',
        'cal_lecP2Q2' => 'decimal:2',
        'cal_pruP2Q2' => 'decimal:2',
        'cal_promP2Q2' => 'decimal:2',
        'cal_promParQ2' => 'decimal:2',
        'cal_promQ2_80' => 'decimal:2',
        'cal_examQ2_10' => 'decimal:2',
        'cal_examQ2_20' => 'decimal:2',
        'cal_promTotalQ2' => 'decimal:2',
        'cal_promAnual' => 'decimal:2',
        'cal_examMejora' => 'decimal:2',
        'cal_examSupletorio' => 'decimal:2',
        'cal_examRemedial' => 'decimal:2',
        'cal_examGracia' => 'decimal:2'
    ];

    public function malla()
    {
        return $this->belongsTo('App\Models\Malla','mal_id');     
    }   

    public function matricula()
    {
        return $this->belongsTo('App\Models\Matricula','mat_id');     
    }   
}
