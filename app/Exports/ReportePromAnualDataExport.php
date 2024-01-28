<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use App\Models\Calificacion;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Malla;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Illuminate\Http\Request;
use Config;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Sheet;

class ReportePromAnualDataExport implements FromView, WithColumnWidths, WithColumnFormatting, ShouldAutoSize, WithEvents
{
    protected $calificacion;
    protected $malla;
    protected $request;

    public function __construct($c_anual=null, $malla_anual=null)
    {
        $this->calificacion=$c_anual;
        $this->malla=$malla_anual;
    }

    /*
        Codigo para generar el reporte anual en Excel de cualquier materia.
    */

    public function view(): View {
        $c_anual=$this->calificacion;
        $malla_anual=$this->malla;
        $abreviatura = request()->input('abreviatura');
        $nom_ape_docente = request()->input('nom_ape_docente');
        $abrev_rector = request()->input('abrev_rector');
        $nom_ape_rector = request()->input('nom_ape_rector');
        $selec_rector = request()->input('selec_rector');
        return view("administrador.calificacion.cursos.materias.reporte-excel.reporteAnual",compact("c_anual", "malla_anual", "abreviatura", "nom_ape_docente", "abrev_rector", "nom_ape_rector", "selec_rector"));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                
                /*
                    Configuración de las fuentes en diferentes celdas
                */

                // Tamaño de fuente en 14
                $cellRange = 'A1:H1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                // Tamaño de fuente en 12
                $cellRange2 = 'A2:H7';
                $event->sheet->getDelegate()->getStyle($cellRange2)->getFont()->setSize(12);

                // Tamaño de fuente en 11
                $cellRange3 = 'A9:H11';
                $event->sheet->getDelegate()->getStyle($cellRange3)->getFont()->setSize(11);

                // Tamaño de fuente en 10
                $cellRange4 = 'A12:H46';
                $event->sheet->getDelegate()->getStyle($cellRange4)->getFont()->setSize(10);

                // Tamaño de fuente en 10
                $cellRange5 = 'A48:H49';
                $event->sheet->getDelegate()->getStyle($cellRange5)->getFont()->setSize(10);

                // Tipo de Letra - Fuente
                $rangoCelda = 'A1:H60';
                $event->sheet->getDelegate()->getStyle($rangoCelda)->getFont()->setName('Cambria');
     
                // Alto de la celda 8 en fila para diseño consistente de la tabla de calificaciones.                  
                $event->sheet->getDelegate()->getRowDimension('8')->setRowHeight(1);

                // Alineamiento del encabezado desde la celda A1 - H1
                $event->sheet->styleCells('A1:H1', [
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Bordes del encabezado del cuadro de promedio anual
                $event->sheet->getStyle('A9:H11')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);

                // Bordes del cuerpo del cuadro de promedio anual
                $event->sheet->getStyle('A12:H46')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);

                // Bordes del pie de página del cuadro del promedio anual
                $event->sheet->getStyle('A48:H49')->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);
            },
        ];
    }    

    /*
        Configuración del tamaño de las celdas
    */

    public function columnWidths(): array
    {
        return [
            'A' => 0.75,
            'B' => 7.50,
            'C' => 1.65,
            'D' => 1.80,
            'E' => 1.65,  
            'F' => 1.65,  
            'G' => 1.65,
            'H' => 2.28    
        ];
    }
    
    /*
        Configuración del formato de celdas en decimal
    */

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'E' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_NUMBER_00,
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
}