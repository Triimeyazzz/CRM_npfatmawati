<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping
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

    public function map($absensi): array
    {
        return [
            $absensi->created_at->format('Y-m-d'),
            $absensi->siswa->nama,
            $absensi->siswa->kelas,
            $absensi->status,
            $absensi->keterangan
        ];
    }
}

