<?php
namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Absensi;
use App\Models\TryOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Subtopic;

class SiswaDashboardController extends Controller
{
    public function index(Request $request)
    {
        $siswa = Auth::guard('siswa')->user(); // Get authenticated student
        if (!$siswa) {
            abort(404, 'Siswa not found');
        }    
        // Fetch student information
        $siswaInfo = [
            'id' => $siswa->id, 
            'nama' => $siswa->nama,
            'email' => $siswa->email,
            'jenis_kelamin' => $siswa->jenis_kelamin,
            'tempat_lahir' => $siswa->tempat_lahir,
            'tanggal_lahir' => $siswa->tanggal_lahir,
            'alamat' => $siswa->alamat,
            'no_telpon' => $siswa->no_telpon,
            'kota' => $siswa->kota,
            'no_wa' => $siswa->no_wa,
            'instagram' => $siswa->instagram,
            'nama_sekolah' => $siswa->nama_sekolah,
            'alamat_sekolah' => $siswa->alamat_sekolah,
            'kurikulum' => $siswa->kurikulum,
            'nama_ayah' => $siswa->nama_ayah,
            'pekerjaan_ayah' => $siswa->pekerjaan_ayah,
            'no_telp_hp_ayah' => $siswa->no_telp_hp_ayah,
            'no_wa_id_line_ayah' => $siswa->no_wa_id_line_ayah,
            'email_ayah' => $siswa->email_ayah,
            'nama_ibu' => $siswa->nama_ibu,
            'pekerjaan_ibu' => $siswa->pekerjaan_ibu,
            'no_telp_hp_ibu' => $siswa->no_telp_hp_ibu,
            'no_wa_id_line_ibu' => $siswa->no_wa_id_line_ibu,
            'email_ibu' => $siswa->email_ibu,
            'kelas' => $siswa->kelas,
            'foto' => $siswa->foto,
            'mulai_bimbingan' => $siswa->mulai_bimbingan,
            'jam_bimbingan' => $siswa->jam_bimbingan,
            'hari_bimbingan' => $siswa->hari_bimbingan,
            'nama_ptn_tujuan' => $siswa->nama_ptn_tujuan,
            'jurusan_tujuan' => $siswa->jurusan_tujuan,
        ];
    
        // Fetch payment information
        $pembayaran = Pembayaran::where('siswa_id', $siswa->id)->with('cicilan')->get();
        $totalTagihan = $pembayaran->sum('jumlah');
        $totalBayar = $pembayaran->flatMap->cicilan->sum('jumlah');
        $sisaTagihan = $totalTagihan - $totalBayar;
    
        $pembayaranInfo = [
            'totalTagihan' => $totalTagihan,
            'totalBayar' => $totalBayar,
            'sisaTagihan' => $sisaTagihan,
        ];
    
        // Fetch attendance information
        $absensi = Absensi::where('siswa_id', $siswa->id)
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();
    
        $absensiInfo = $absensi->map(function ($item) {
            return [
                'tanggal' => $item->tanggal,
                'status' => $item->status,
                'keterangan' => $item->keterangan,
            ];
        });
    
        // Fetch monthly attendance summary
        $monthlyAttendance = Absensi::where('siswa_id', $siswa->id)
            ->selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total_hadir, SUM(status = "Hadir") as total_hadir')
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();
    
        $attendancePerMonth = $monthlyAttendance->map(function ($item) {
            return [
                'bulan' => $item->bulan,
                'total_hadir' => $item->total_hadir,
            ];
        });
    
        // Fetch TryOut information
$tryOuts = TryOut::where('id_siswa', $siswa->id)
->with('subtopics')
->orderBy('tanggal_pelaksanaan', 'desc')
->take(5)
->get();

$tryOutInfo = $tryOuts->map(function ($tryOut) {
return [
    'mata_pelajaran' => $tryOut->mata_pelajaran,
    'tanggal_pelaksanaan' => $tryOut->tanggal_pelaksanaan,
    'average_score' => $tryOut->subtopics->avg('skor'),
    'subtopics' => $tryOut->subtopics->map(function ($subtopic) {
        return [
            'sub_mata_pelajaran' => $subtopic->sub_mata_pelajaran,
            'skor' => $subtopic->skor,
        ];
    }),
];
});
        return view('siswa.dashboard', [
            'siswa' => $siswa,
            'siswaInfo' => $siswaInfo,
            'pembayaranInfo' => $pembayaranInfo,
            'absensiInfo' => $absensiInfo,
            'attendancePerMonth' => $attendancePerMonth,
            'tryOutInfo' => $tryOutInfo,
            'subtopics' => $tryOuts->pluck('mata_pelajaran'),
        ]);
    }

    public function getSubtopics($subject)
    {
        $subtopics = Subtopic::where('mata_pelajaran', $subject)->get();
        return response()->json($subtopics);
    }

    public function showAttendance(Request $request)
    {
        $user = Auth::user();
        $siswa = Siswa::findOrFail($user->id);
        $siswaInfo = [
            'id' => $siswa->id, 
            'nama' => $siswa->nama,
            'email' => $siswa->email,
            'jenis_kelamin' => $siswa->jenis_kelamin,
            'tempat_lahir' => $siswa->tempat_lahir,
            'tanggal_lahir' => $siswa->tanggal_lahir,
            'alamat' => $siswa->alamat,
            'no_telpon' => $siswa->no_telpon,
            'kota' => $siswa->kota,
            'no_wa' => $siswa->no_wa,
            'instagram' => $siswa->instagram,
            'nama_sekolah' => $siswa->nama_sekolah,
            'alamat_sekolah' => $siswa->alamat_sekolah,
            'kurikulum' => $siswa->kurikulum,
            'nama_ayah' => $siswa->nama_ayah,
            'pekerjaan_ayah' => $siswa->pekerjaan_ayah,
            'no_telp_hp_ayah' => $siswa->no_telp_hp_ayah,
            'no_wa_id_line_ayah' => $siswa->no_wa_id_line_ayah,
            'email_ayah' => $siswa->email_ayah,
            'nama_ibu' => $siswa->nama_ibu,
            'pekerjaan_ibu' => $siswa->pekerjaan_ibu,
            'no_telp_hp_ibu' => $siswa->no_telp_hp_ibu,
            'no_wa_id_line_ibu' => $siswa->no_wa_id_line_ibu,
            'email_ibu' => $siswa->email_ibu,
            'kelas' => $siswa->kelas,
            'foto' => $siswa->foto,
            'mulai_bimbingan' => $siswa->mulai_bimbingan,
            'jam_bimbingan' => $siswa->jam_bimbingan,
            'hari_bimbingan' => $siswa->hari_bimbingan,
        ];
        // Retrieve all attendance records for the student
        $absensi = Absensi::where('siswa_id', $siswa->id)
            ->orderBy('tanggal', 'desc')
            ->get();
    
        // Check if a month filter is applied
        $selectedMonth = $request->get('month');
    
        // Filter attendance records by the selected month
        $absensiInfo = $absensi->filter(function ($item) use ($selectedMonth) {
            if ($selectedMonth) {
                return Carbon::parse($item->tanggal)->format('Y-m') === $selectedMonth;
            }
            return true; // If no month is selected, return all records
        })->map(function ($item) {
            return [
                'tanggal' => $item->tanggal,
                'status' => $item->status,
                'keterangan' => $item->keterangan,
            ];
        });
    
        return view('siswa.attendance', [

            'absensiInfo' => $absensiInfo, // Use this variable in the view
            'siswa' => $siswa,
            'selectedMonth' => $selectedMonth, // Pass the selected month to the view
            'siswaInfo' => $siswaInfo,
        ]);
    }
    
}
