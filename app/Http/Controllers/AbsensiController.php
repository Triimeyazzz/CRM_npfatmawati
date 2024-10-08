<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Siswa;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $kelas = $request->query('kelas');
        $tanggal = $request->query('tanggal');

        $query = Absensi::query()->with('siswa');

        if ($kelas) {
            $query->whereHas('siswa', function ($query) use ($kelas) {
                $query->where('kelas', $kelas);
            });
        }

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        $absensi = $query->get();

        // Group by date
        $absensiGroupedByDate = $absensi->groupBy('tanggal');

        $classes = Siswa::select('kelas')->distinct()->pluck('kelas');

        return view('absensi.index', [
            'absensi' => $absensi,
            'absensiData' => $absensi->toArray(),
            'absensiGroupedByDate' => $absensiGroupedByDate,
            'classes' => $classes,
            'selectedClass' => $kelas,
            'selectedDate' => $tanggal,
            'auth' => auth()->user(),
        ]);
    }

    public function create()
    {
        $siswa = Siswa::all();
        $classes = Siswa::distinct()->pluck('kelas');
        return view('absensi.create', [
            'siswa' => $siswa,
            'classes' => $classes,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'absensi' => 'required|array',
            'absensi.*.siswa_id' => 'required|exists:siswa,id',
            'absensi.*.status' => 'required|in:Hadir,Tidak Hadir',
            'absensi.*.keterangan' => 'nullable|string',
        ]);

        foreach ($request->absensi as $absen) {
            Absensi::updateOrCreate(
                [
                    'siswa_id' => $absen['siswa_id'],
                    'tanggal' => $request->tanggal,
                ],
                [
                    'status' => $absen['status'],
                    'keterangan' => $absen['keterangan'] ?? null,
                ]
            );
        }

        return redirect()->route('absensi.index')->with('success', 'Data berhasil disimpan.');
    }

    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('absensi.index')->with('success', 'Data berhasil dihapus.');
    }

    public function scan()
    {
        return view('absensi.scan');
    }

    public function scanQr(Request $request)
    {
        $siswa = Siswa::find($request->id);

        Absensi::updateOrCreate(
            [
                'siswa_id' => $siswa->id,
                'tanggal' => date('Y-m-d'),
            ],
            [
                'status' => "Hadir",
                'keterangan' => null,
            ]
        );

        return back()->with('success', 'Absensi berhasil dicatat.');
    }

    public function exportPdf() {
        $absensis = Absensi::all();
        $data = [

            'absensis' => $absensis
        ];

        // Menghasilkan file PDF dari view 'pdf_template'
        $pdf = PDF::loadView('pdf_template', $data);

        // Mengembalikan download file PDF
        return $pdf->download('apa-ini.pdf');
    }

    public function exportExcel() {
        return Excel::download(new AbsensiExport(Absensi::all()), 'absensi.xlsx');
    }
}