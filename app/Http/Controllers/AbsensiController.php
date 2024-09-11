<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;
use Barryvdh\Snappy\Facades\SnappyPDF;

class AbsensiController extends Controller
{
    public function index(Request $request)
{
    $absensiData = Absensi::with('siswa')->get();

    $kelas = $request->query('kelas');
    $bulan = $request->query('bulan');
    $tanggal = $request->query('tanggal');
    $search = $request->query('search');

    $query = Absensi::query()->with('siswa');

    // Filter by class
    if ($kelas) {
        $query->whereHas('siswa', function ($query) use ($kelas) {
            $query->where('kelas', $kelas);
        });
    }

    // Filter by date
    if ($tanggal) {
        $query->whereDate('tanggal', $tanggal);
    }

    // Filter by month
    if ($bulan) {
        $query->whereMonth('tanggal', $bulan);
    }

    // Search by student name
    if ($search) {
        $query->whereHas('siswa', function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%");
        });
    }

    // Get the attendance records
    $absensi = $query->get();

    // Group by date
    $absensiGroupedByDate = $absensi->groupBy('tanggal');

    // Get distinct classes
    $classes = Siswa::select('kelas')->distinct()->pluck('kelas');

    return view('absensi.index', [
        'absensi' => $absensi,
        'absensiData' => $absensiData,
        'absensiGroupedByDate' => $absensiGroupedByDate,
        'classes' => $classes,
        'selectedClass' => $kelas,
        'selectedDate' => $tanggal,
        'selectedMonth' => $bulan,
        'auth' => auth()->user(),
    ]);
}


public function create()
{
    $siswa = Siswa::all(); // Fetch all students
    $classes = Siswa::distinct()->pluck('kelas'); // Fetch unique classes

    return view('absensi.create', compact('siswa', 'classes'));
}


public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'absensi' => 'required|array',
        'absensi.*.status' => 'required|string',
        'absensi.*.keterangan' => 'nullable|string',
        'absensi.*.siswa_id' => 'required|exists:siswa,id',
        'hari_bimbingan' => 'required|array',
    ]);

    foreach ($request->absensi as $item) {
        // Create or update the attendance record
        Attendance::updateOrCreate(
            [
                'siswa_id' => $item['siswa_id'],
                'tanggal' => $request->tanggal,
            ],
            [
                'status' => $item['status'],
                'keterangan' => $item['keterangan'],
                'hari_bimbingan' => json_encode($request->hari_bimbingan), // Store selected days
            ]
        );
    }

    return redirect()->route('absensi.index')->with('success', 'Absen berhasil disimpan.');
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

    public function exportExcel(Request $request)
{
    // Prepare the data based on the filters
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

    return Excel::download(new AbsensiExport($absensi), 'absensi.xlsx');
}

public function exportPDF(Request $request)
{
    // Prepare the data based on the filters
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

    $pdf = SnappyPDF::loadView('absensi.pdf', ['absensi' => $absensi]);
    return $pdf->download('absensi.pdf');
}
}
