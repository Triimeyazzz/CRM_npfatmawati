<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::all(['nama',
        'email',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telpon',
        'kota',
        'no_wa',
        'instagram',
        'nama_sekolah',
        'alamat_sekolah',
        'kurikulum',
        'nama_ayah',
        'pekerjaan_ayah',
        'no_telp_hp_ayah',
        'no_wa_id_line_ayah',
        'email_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'no_telp_hp_ibu',
        'no_wa_id_line_ibu',
        'kelas',
        'email_ibu',
        'foto',
        'user_id',
        'mulai_bimbingan', 
        'jam_bimbingan', 
        'hari_bimbingan',
        'nama_ptn_tujuan',
        'jurusan_tujuan']);
    
        $query = Siswa::query();

        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        }

        if ($this->kelas) {
            $query->where('kelas', $this->kelas);
        }

        return $query->get();

    }

    public function headings(): array
    {
        return [
            'nama',
        'email',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telpon',
        'kota',
        'no_wa',
        'instagram',
        'nama_sekolah',
        'alamat_sekolah',
        'kurikulum',
        'nama_ayah',
        'pekerjaan_ayah',
        'no_telp_hp_ayah',
        'no_wa_id_line_ayah',
        'email_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'no_telp_hp_ibu',
        'no_wa_id_line_ibu',
        'kelas',
        'email_ibu',
        'foto',
        'user_id',
        'mulai_bimbingan', 
        'jam_bimbingan', 
        'hari_bimbingan',
        'nama_ptn_tujuan',
        'jurusan_tujuan'
        ];
    }
    protected $search;
    protected $kelas;

    public function __construct($search = '', $kelas = '')
    {
        $this->search = $search;
        $this->kelas = $kelas;
    }

    
}
