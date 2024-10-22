<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use ZipArchive;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
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

    // Dapatkan daftar siswa
    $siswa = $siswaQuery->get();

    // Hitung total siswa
    $total_siswa = $siswa->count();

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
        'total_siswa' => $total_siswa, // Kirim total siswa ke view
    ]);
}


    public function cetakqr($id)
    {
        $qrCode = QrCode::create($id)
            ->setSize(300)
            ->setMargin(10); // Atur margin jika perlu

        $logoPath = asset('/images/reverse.png'); // Ganti dengan path logo Anda
        $logo = null;
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
        $logo = null;
        $logoPath = asset('images/logo color.png'); // Ganti dengan path logo Anda
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
            'hari_bimbingan' => 'required|array',
            'nama_ptn_tujuan' => 'nullable|string', // Validasi nama PTN tujuan
            'jurusan_tujuan' => 'nullable|string',  // Validasi jurusan yang dituju
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
            $filename = $file->getClientOriginalName(); // Mendapatkan nama asli file
            $file->storeAs('photos', $filename, 'public'); // Menyimpan file ke folder 'photos' di disk 'public'
            $siswa->foto = $filename; // Menyimpan hanya nama file ke dalam database
        }
        

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
            'hari_bimbingan' => 'required|array',
             'nama_ptn_tujuan' => 'nullable|string', // Validasi nama PTN tujuan
            'jurusan_tujuan' => 'nullable|string',  // Validasi jurusan yang dituju
        ]);

            // Handle file upload if applicable
    if ($request->hasFile('foto')) {
        // Delete the old photo if it exists
        if ($siswa->foto) {
            // You may want to adjust this path based on your storage setup
            $oldPhotoPath = public_path('storage/fotos/' . $siswa->foto);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath); // Delete old photo
            }
        }

        // Save the new photo
        $file = $request->file('foto');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = '/home/u174913696/domains/newprimagamafatmawati.com/public_html/storage/fotos'; // Update this path
        $file->move($destinationPath, $filename);

        // Update the foto attribute
        $siswa->foto = $filename;
    }
    $siswa->save();


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

    public function destroy($id)
{
    {
        $id->delete();
        return redirect()->route('adminsiswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}

public function bulkDownload(Request $request)
{
    // Validate the selected IDs
    $request->validate([
        'selected_ids' => 'required|array',
        'selected_ids.*' => 'exists:siswa,id',
    ]);

    // Retrieve the selected siswa IDs
    $selectedIds = $request->input('selected_ids');

    // Create a zip file
    $zip = new \ZipArchive();
    $zipFileName = 'qr_codes.zip';
    $zipFilePath = storage_path($zipFileName);
    
    if ($zip->open($zipFilePath, \ZipArchive::CREATE) === TRUE) {
        foreach ($selectedIds as $id) {
            // Retrieve the student by ID
            $student = Siswa::find($id);

            // Generate the QR Code image URL
            $qrCodeUrl = route('adminsiswa.qrcode', $id);
            $qrCodeImage = file_get_contents($qrCodeUrl);

            // Use the student's name for the filename
            $fileName = strtolower(str_replace(' ', '_', $student->nama)); // Replace spaces with underscores and make lowercase
            $zip->addFromString("qrcode_{$fileName}_{$id}.png", $qrCodeImage);
        }
        $zip->close();
    }

    // Return the zip file as a response
    return response()->download($zipFilePath)->deleteFileAfterSend(true);
}

public function exportPdf() {
    // Get all absensi records
    $siswa = Siswa::all(); // Change variable name to $absensi
    $data = [
        'siswa' => $siswa // Ensure the variable name matches the view's expected variable
    ];

    // Generate PDF from the view
    $pdf = PDF::loadView('admin_siswa.pdf', $data);

    // Return the PDF download
    return $pdf->download('Data-Siswa.pdf');
}


    public function exportExcel(Request $request )
    {
        $search = $request->input('search', '');
    $kelas = $request->input('kelas', '');

    return Excel::download(new SiswaExport($search, $kelas), 'daftar_siswa_terfilter.xlsx');

        return Excel::download(new SiswaExport, 'daftar_siswa.xlsx');
    }
}

