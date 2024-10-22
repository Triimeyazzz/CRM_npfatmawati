<?php
namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Cicilan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        // Menangani pencarian
        $search = $request->input('search');

        // Ambil pembayaran dengan pencarian jika ada
        $pembayaran = Pembayaran::with('siswa')
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->get();

        // Hitung total cicilan
        $totalCicilan = Cicilan::sum('jumlah');

        // Total tagihan
        $totalTagihan = Pembayaran::sum('jumlah') ?: 0; // Default to 0 if no payments

        // Total sisa cicilan
        $sisaCicilan = $totalTagihan - $totalCicilan;

        // Hitung pemasukan per bulan dari cicilan
        $pemasukanPerBulan = Cicilan::select(
            DB::raw('DATE_FORMAT(dibayar_pada, "%Y-%m") as bulan'),
            DB::raw('SUM(jumlah) as total')
        )
        ->groupBy('bulan')
        ->get();

 // Format data for Chart.js
 $labels = $pemasukanPerBulan->pluck('bulan')->toArray();
 $data = $pemasukanPerBulan->pluck('total')->toArray();

        // Total pemasukan
        $totalPemasukan = $pemasukanPerBulan->sum('total');

        // Sisa tagihan
        $sisaTagihan = $totalTagihan - $totalPemasukan;

        return view('pembayaran.index', compact('pembayaran', 'labels', 'data', 'totalPemasukan', 'totalTagihan', 'sisaTagihan', 'search'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('pembayaran.create', ['siswa' => $siswa]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'jumlah' => 'required|numeric|min:0',
            'tgl_jatuh_tempo' => 'required',
        ]);

        Pembayaran::create($validated + ['status' => 'pending']);
                
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dibuat');
    }

    public function bayarCicilan(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'jumlah' => 'required|numeric|min:0',
        ]);

        $cicilan = new Cicilan([
            'jumlah' => $validated['jumlah'],
            'dibayar_pada' => now(),
            'siswa_id' => $pembayaran->siswa_id,
        ]);

        $pembayaran->cicilan()->save($cicilan);

        $totalBayar = $pembayaran->cicilan()->sum('jumlah');
        if ($totalBayar >= $pembayaran->jumlah) {
            $pembayaran->update(['status' => 'selesai']);
        }

        return redirect()->route('pembayaran.index');
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with('siswa', 'cicilan')->findOrFail($id);
        
        // Calculate total cicilan
        $totalCicilan = $pembayaran->cicilan->sum('jumlah');
        
        // Calculate remaining balance
        $sisaCicilan = $pembayaran->jumlah - $totalCicilan;

        return view('pembayaran.show', compact('pembayaran', 'totalCicilan', 'sisaCicilan'));
    }

    public function financialSummary()
    {
        // Total pemasukan dari cicilan
        $totalPemasukan = Cicilan::sum('jumlah');

        // Pemasukan per bulan dari cicilan
        $pemasukanPerBulan = Cicilan::select(
            DB::raw('YEAR(dibayar_pada) as year'),
            DB::raw('MONTH(dibayar_pada) as month'),
            DB::raw('SUM(jumlah) as total')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Total tagihan
        $totalTagihan = Pembayaran::sum('jumlah');
        
        // Sisa tagihan
        $sisaTagihan = $totalTagihan - $totalPemasukan;

        return view('pembayaran.financialSummary', compact('totalPemasukan', 'pemasukanPerBulan', 'totalTagihan', 'sisaTagihan'));
    }

    public function destroyCicilan($id)
    {
        $cicilan = Cicilan::findOrFail($id);
        $cicilan->delete();

        return response()->json(['success' => true]);
    }

    public function cancel($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = 'batal'; // Use quotes if assigning directly
        $pembayaran->save();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran dibatalkan.');
    }

    public function cancelNew($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        if ($pembayaran->status !== 'selesai') {
            $pembayaran->status = 'batal';
            $pembayaran->save();

            $cicilan = Cicilan::where('pembayaran_id', $id)->first();
            if ($cicilan) {
                $cicilan->delete();
            }
            return redirect()->route('pembayaran.index');
        }
        return response()->json(['success' => false]);
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
