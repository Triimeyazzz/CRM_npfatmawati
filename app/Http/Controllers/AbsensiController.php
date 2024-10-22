<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    public function index(Request $request)
{
    $kelas = $request->query('kelas');
    $tanggal = $request->query('tanggal');
    $search = $request->query('search');
    $bulan = $request->query('bulan');

    $query = Absensi::query()->with('siswa');

    // Filter berdasarkan kelas
    if ($kelas) {
        $query->whereHas('siswa', function ($query) use ($kelas) {
            $query->where('kelas', $kelas);
        });
    }

    // Filter berdasarkan nama siswa
    if ($search) {
        $query->whereHas('siswa', function ($query) use ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        });
    }

    // Filter berdasarkan tanggal
    if ($tanggal) {
        $query->whereDate('tanggal', $tanggal);
    }

    // Filter berdasarkan bulan
    if ($bulan) {
        $query->whereMonth('tanggal', $bulan);
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
        'selectedSearch' => $search,
        'selectedMonth' => $bulan,
        'auth' => auth()->user(),
    ]);
}

public function create(Request $request)
{
    // Ambil filter dari request
    $kelas = $request->query('kelas');
    $nama = $request->query('nama'); // Menangkap nama siswa dari query
    $hari_bimbingan = $request->query('hari_bimbingan');

    // Query untuk siswa dengan filter opsional
    $query = Siswa::query();

    if ($kelas) {
        $query->where('kelas', $kelas);
    }

    if ($nama) {
        $query->where('nama', 'LIKE', '%' . $nama . '%'); // Filter berdasarkan nama siswa
    }

    if ($hari_bimbingan) {
        // Memastikan filter berdasarkan hari bimbingan
        $query->where('hari_bimbingan', $hari_bimbingan);
    }

    $siswa = $query->get();
    $classes = Siswa::distinct()->pluck('kelas');
    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']; // Daftar hari untuk 'hari bimbingan'

    return view('absensi.create', [
        'siswa' => $siswa,
        'classes' => $classes,
        'days' => $days,
        'selectedClass' => $kelas,
        'selectedDay' => $hari_bimbingan,
    ]);
}


public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'absensi' => 'required|array',
            'absensi.*.siswa_id' => 'required|exists:siswa,id', // Pastikan siswa_id ada di database
            'absensi.*.tanggal' => 'required|date',
            'absensi.*.status' => 'required|string', // Misalnya: 'hadir', 'tidak hadir', dll.
            'absensi.*.keterangan' => 'nullable|string',
        ]);

        // Loop melalui data absensi
        foreach ($request->absensi as $data) {
            // Cek apakah siswa_id, tanggal, dan status sudah diinput
            if (!empty($data['siswa_id']) && !empty($data['tanggal']) && !empty($data['status'])) {
                Absensi::create([
                    'siswa_id' => $data['siswa_id'],
                    'tanggal' => $data['tanggal'],
                    'status' => $data['status'],
                    'keterangan' => $data['keterangan'] ?? null, // Jika tidak ada keterangan, gunakan null
                ]);
            }
        }

        // Kembalikan response atau redirect sesuai kebutuhan
        return redirect()->route('absensi.index')->with('success', 'Data berhasil ditambahkan.');

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
    // Get all absensi records
    $absensi = Absensi::all(); // Change variable name to $absensi
    $data = [
        'absensi' => $absensi // Ensure the variable name matches the view's expected variable
    ];

    // Generate PDF from the view
    $pdf = PDF::loadView('absensi.pdf', $data);

    // Return the PDF download
    return $pdf->download('Laporan-absensi.pdf');
}


    public function exportExcel() {
        return Excel::download(new AbsensiExport(Absensi::all()), 'absensi.xlsx');
    }
}