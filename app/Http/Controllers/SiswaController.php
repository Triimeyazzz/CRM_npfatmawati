<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $kelas = $request->input('kelas', '');

        $siswaQuery = Siswa::query();

        if ($search) {
            $siswaQuery->where('nama', 'like', "%{$search}%");
        }

        if ($kelas) {
            $siswaQuery->where('kelas', $kelas);
        }

        $siswa = $siswaQuery->get();

        foreach ($siswa as $item) {
            // Buat QR Code
            $qrCode = QrCode::create($item->id)
                ->setSize(300)
                ->setMargin(10); // Atur margin jika perlu

            // Konversi QR Code menjadi string PNG
            $writer = new PngWriter();
            $item->qr_code = $writer->write($qrCode)->getString();
        }

        return view('admin_siswa.index', [
            'siswa' => $siswa,
            'total_siswa' => $siswa->count(),
        ]);
    }

    public function cetakqr($id)
    {
        $qrCode = QrCode::create($id)
            ->setSize(300)
            ->setMargin(10); // Atur margin jika perlu

        $logoPath = public_path('images/reverse.png'); // Ganti dengan path logo Anda
        if (file_exists($logoPath)) {
            $logo = Logo::create($logoPath)
                ->setResizeToWidth(100)
                ->setPunchoutBackground(false)
            ;
        }

        // Buat writer dan response
        $writer = new PngWriter();
        $response = $writer->write($qrCode, $logo);

        return response($response->getString())
            ->header('Content-Type', 'image/png');
    }

    public function downloadQrCode($id)
    {
        $siswa = Siswa::findOrFail($id);

        // Buat kode QR
        $qrCode = QrCode::create($siswa->id)
            ->setSize(300)
            ->setMargin(10); // Atur margin jika perlu

        // Tambahkan logo
        $logoPath = public_path('images/logo color.png'); // Ganti dengan path logo Anda
        if (file_exists($logoPath)) {
            $logo = Logo::create($logoPath)
                ->setResizeToWidth(100)
                ->setPunchoutBackground(false)
            ;
        }

        $writer = new PngWriter();
        $response = $writer->write($qrCode, $logo);

        return response($response->getString(), 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="qrcode-' . $siswa->nama . '.png"',
        ]);
    }
    public function create()
    {
        return view('admin_siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:siswa,email',
            'password' => 'required|string|min:8',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'no_telpon' => 'nullable|string',
            'no_wa' => 'nullable|string',
            'instagram' => 'nullable|string',
            'nama_sekolah' => 'required|string',
            'alamat_sekolah' => 'required|string',
            'kurikulum' => 'required|string',
            'nama_ayah' => 'required|string',
            'pekerjaan_ayah' => 'nullable|string',
            'no_telp_hp_ayah' => 'nullable|string',
            'no_wa_id_line_ayah' => 'nullable|string',
            'email_ayah' => 'nullable|email',
            'nama_ibu' => 'required|string',
            'pekerjaan_ibu' => 'nullable|string',
            'no_telp_hp_ibu' => 'nullable|string',
            'no_wa_id_line_ibu' => 'nullable|string',
            'email_ibu' => 'nullable|email',
            'foto' => 'nullable|image|max:2048',
            'kelas' => 'nullable|string',
            'mulai_bimbingan' => 'required|date',
            'jam_bimbingan' => 'required|date_format:H:i',
                    'hari_bimbingan' => 'required|array'
        ]);

        $siswa = new Siswa();
        $siswa->fill($request->except('foto', 'password', 'hari_bimbingan'));
        $siswa->update([
            // ... other fields ...
            'jam_bimbingan' => $request->input('jam_bimbingan'), // This should be the formatted time
        ]);
        $siswa->password = Hash::make($request->input('password'));

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/fotos', $filename);
            $siswa->foto = $filename;
        }

        $siswa->save();

        $siswa->hari_bimbingan = json_encode($request->input('hari_bimbingan'));
        $siswa->save();

        return redirect()->route('adminsiswa.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('admin_siswa.edit', [
            'siswa' => $siswa
        ]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:siswa,email,' . $siswa->id,
            'kelas' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telpon' => 'nullable|string|max:20',
            'kota' => 'required|string|max:255',
            'no_wa' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'nama_sekolah' => 'required|string|max:255',
            'alamat_sekolah' => 'required|string',
            'kurikulum' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'no_telp_hp_ayah' => 'nullable|string|max:20',
            'no_wa_id_line_ayah' => 'nullable|string|max:20',
            'email_ayah' => 'nullable|string|email|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'no_telp_hp_ibu' => 'nullable|string|max:20',
            'no_wa_id_line_ibu' => 'nullable|string|max:20',
            'email_ibu' => 'nullable|string|email|max:255',
            'mulai_bimbingan' => 'required|date',
            'jam_bimbingan' => 'required|date_format:H:i',
            'hari_bimbingan' => 'required|array'
        ]);

        // Handle file upload if applicable
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('photos', 'public');
            $siswa->foto = $path;
        }

        // Update the Siswa instance with the validated data
        $validated['hari_bimbingan'] = json_encode($validated['hari_bimbingan']);
        $siswa->update($validated);

        return redirect()->route('adminsiswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function show(Siswa $siswa)
    {
        return view('admin_siswa.show', [
            'siswa' => $siswa,
        ]);
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('adminsiswa.index')->with('success', 'Siswa berhasil dihapus.');
    }



}
