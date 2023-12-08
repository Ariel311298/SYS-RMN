<?php

namespace App\Http\Controllers\Rector;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\PadreApoderado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PadresApoderadosController extends Controller
{
    /**
     * Muestra la lista de los padres o representantes registrados.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $padresapoderados = PadreApoderado::sortable()->paginate(10);
        return view('rector.padreapoderado.index', ['padresapoderados' => $padresapoderados]);   
    }
}
