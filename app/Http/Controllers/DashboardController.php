<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Cicilan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard data count.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalAdmins = User::count();
        $totalSiswa = Siswa::count();

        $siswas = Siswa::get();

        // Calculate sums
        $totalPemasukan = Cicilan::sum('jumlah') ?? 0; // Default to 0 if null
        $totalTagihan = Pembayaran::sum('jumlah') ?? 0; // Default to 0 if null
        $sisaTagihan = $totalTagihan - $totalPemasukan;

        $pemasukanPerBulan = Cicilan::select(
            DB::raw('YEAR(dibayar_pada) as year'),
            DB::raw('MONTH(dibayar_pada) as month'),
            DB::raw('SUM(jumlah) as total')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        $user = Auth::user();

        return view('dashboard', compact(
            'user',
            'siswas',
            'totalAdmins',
            'totalSiswa',
            'totalPemasukan',
            'totalTagihan',
            'sisaTagihan',
            'pemasukanPerBulan'
        ));
    }

    /**
     * Display the detailed data for admins and students.
     *
     * @return \Illuminate\View\View
     */
    public function data()
    {
        $admins = User::take(5)->get();
        $siswa = Siswa::take(8)->get();

        return view('dashboard.data', compact('admins', 'siswa'));
    }
}
