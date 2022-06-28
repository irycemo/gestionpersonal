<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class InasistenciasExport implements FromCollection,  WithProperties, WithDrawings, ShouldAutoSize, WithEvents, WithCustomStartCell, WithColumnWidths, WithHeadings, WithMapping
{

    public function __construct($coleccion)
    {
        $this->coleccion = $coleccion;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->coleccion;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(storage_path('app/public/img/logo2.png'));
        $drawing->setHeight(90);
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(10);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function headings(): array
    {
        return [
            'Motivo',
            'Fecha',
            'Empleado',
            'Registrado por',
            'Actualizado por',
            'Registrado en',
            'Actualizado en'
        ];
    }

    public function map($inasistencia): array
    {
        return [
            $inasistencia->motivo,
            $inasistencia->fecha,
            $inasistencia->persona->nombre,
            $inasistencia->createdBy ? $inasistencia->createdBy->name : 'N/A',
            $inasistencia->updatedBy ? $inasistencia->updatedBy->name : 'N/A',
            $inasistencia->created_at,
            $inasistencia->updated_at,
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'title'          => 'Reporte de inasistencias (Sistema de Gestión Personal)',
            'company'        => 'Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:G1');
                $event->sheet->setCellValue('A1', "Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo\nReporte de inasistencias (Sistema de Gestión Personal)\n" . now()->format('d-m-Y'));
                $event->sheet->getStyle('A1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 13
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);
                $event->sheet->getRowDimension('1')->setRowHeight(90);
                $event->sheet->getStyle('A2:K2')->applyFromArray([
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );
            },
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function columnWidths(): array
    {
        return [
            'E' => 45,
            'F' => 20,

        ];
    }
}
