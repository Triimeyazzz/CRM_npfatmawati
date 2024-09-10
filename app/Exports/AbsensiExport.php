<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    protected $absensi;

    public function __construct($absensi)
    {
        $this->absensi = $absensi;
    }

    public function collection()
    {
        return $this->absensi;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Siswa',
            'Kelas',
            'Status',
            'Keterangan',
        ];
    }
}

