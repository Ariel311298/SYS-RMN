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

class ReporteQ1DataExport implements FromView, WithColumnWidths, WithColumnFormatting, ShouldAutoSize, WithEvents
{
    protected $calificacion;
    protected $malla;
    protected $request;

    public function __construct($calificaciones_q1=null, $malla_q1=null)
    {
        $this->calificacion=$calificaciones_q1;
        $this->malla=$malla_q1;
    }

    /*
        Codigo para generar el reporte del primer quimestre en Excel
    */

    public function view(): View {
        $calificaciones_q1=$this->calificacion;
        $malla_q1=$this->malla;
        $abreviatura = request()->input('abreviatura');
        $nom_ape_docente = request()->input('nom_ape_docente');
        return view("administrador.calificacion.cursos.materias.reporte-excel.reporteQ1",compact("calificaciones_q1", "malla_q1", "abreviatura", "nom_ape_docente"));
    }

    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Tamaño de fuente en 11
                $cellRange = 'A1:H450';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11);

                // Tipo de Letra - Fuente
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Cambria');
     
                // Alineamiento del encabezado desde la celda A1 - H1
                $event->sheet->styleCells('A1:T1', [
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Bordes del encabezado del cuadro quimestral
                $event->sheet->getStyle('A7:T9')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);

                // Bordes del cuerpo del cuadro quimestral
                $event->sheet->getStyle('A10:T44')->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);
                
                // Bordes para las calificaciones
                $event->sheet->getStyle('A10:S44')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);

                /**
                 * Bordes para cubrir la sección Prom. Parcial 
                */
                
                $event->sheet->getStyle('T10')->applyFromArray([
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('T11')->applyFromArray([
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('T12')->applyFromArray([
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('T13')->applyFromArray([
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('T14')->applyFromArray([
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('T15')->applyFromArray([
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('T15')->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);

                // Borde para crear la linea de firma
                $event->sheet->getStyle('I48:M48')->applyFromArray([
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
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
            'A' => 9.71,
            'B' => 39.14,
            'C' => 19.15,
            'D' => 12.86,
            'E' => 10.29,  
            'F' => 8.34,  
            'G' => 8.34,
            'H' => 8.34    
        ];
    }
    
    /*
        Configuración del formato de celdas en decimal
    */

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'E' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_NUMBER_00,
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER_00,
            'J' => NumberFormat::FORMAT_NUMBER_00,
            'K' => NumberFormat::FORMAT_NUMBER_00,
            'L' => NumberFormat::FORMAT_NUMBER_00,
            'M' => NumberFormat::FORMAT_NUMBER_00,
            'N' => NumberFormat::FORMAT_NUMBER_00,
            'O' => NumberFormat::FORMAT_NUMBER_00,
            'P' => NumberFormat::FORMAT_NUMBER_00,
            'Q' => NumberFormat::FORMAT_NUMBER_00,
            'R' => NumberFormat::FORMAT_NUMBER_00,
            'S' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }    
}
