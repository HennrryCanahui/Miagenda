<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ContactosExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $contactos;

    public function __construct($contactos)
    {
        $this->contactos = $contactos;
    }

    public function collection()
    {
        return $this->contactos->map(function($contacto) {
            return [
                'Nombre Completo' => $contacto->nombres . ' ' . $contacto->apellidos,
                'Email' => $contacto->email ?: 'No registrado',
                'Teléfono' => $contacto->telefonos->first()->numero ?? 'No registrado',
                'Categoría' => $contacto->categoria->nombre ?? 'No registrado',
                'Dirección' => $contacto->direccion ?: 'No registrado',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombre Completo',
            'Email',
            'Teléfono',
            'Categoría',
            'Dirección',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2563EB']], // Blue background
            ],
        ];
    }
}
