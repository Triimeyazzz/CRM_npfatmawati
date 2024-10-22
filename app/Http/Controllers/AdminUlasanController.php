<?php
namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;


class AdminUlasanController extends Controller
{
public function index()
{
    $ulasan = Ulasan::with('siswa')->get(); // Eager load the siswa relationship
    return view('ulasan.index', compact('ulasan'));

    
}
    public function create()
    {
        return view('ulasan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pemberi_ulasan' => 'required|string',
            'tipe_pemberi_ulasan' => 'required|in:alumni,orang_tua,lainnya,siswa',
            'foto_profile' => 'nullable|image|max:2048',
            'penilaian' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        // Inisialisasi model Ulasan
        $ulasan = new Ulasan();
        $ulasan->nama_pemberi_ulasan = $request->nama_pemberi_ulasan;
        $ulasan->tipe_pemberi_ulasan = $request->tipe_pemberi_ulasan;
        $ulasan->penilaian = $request->penilaian;
        $ulasan->komentar = $request->komentar;

        // Proses upload foto jika ada
        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            $filename = $file->getClientOriginalName(); // Mendapatkan nama asli file
            $file->storeAs('foto_profile', $filename, 'public'); // Menyimpan file ke folder 'photos' di disk 'public'
            $ulasan->foto = $filename; // Menyimpan hanya nama file ke dalam database
        }
        

        // Simpan data ulasan ke database
        $ulasan->save();

        // Redirect ke halaman ulasan dengan pesan sukses
        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil ditambahkan');
    }

    public function edit($id)
{
    $ulasan = Ulasan::findOrFail($id); // Retrieve the review by ID
    return view('ulasan.edit', compact('ulasan')); // Pass the review to the edit view
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_pemberi_ulasan' => 'required|string',
        'tipe_pemberi_ulasan' => 'required|in:alumni,orang_tua,lainnya,siswa',
        'foto_profile' => 'nullable|image|max:2048',
        'penilaian' => 'required|integer|min:1|max:5',
        'komentar' => 'required|string',
    ]);

    $ulasan = Ulasan::findOrFail($id); // Retrieve the review by ID
    $ulasan->fill($request->all()); // Fill the review with request data

    // Check if a new profile picture has been uploaded
    if ($request->hasFile('foto_profile')) {
        // Delete the old profile picture if it exists
        if ($ulasan->foto_profile) {
            $oldFilePath = '/home/u174913696/domains/newprimagamafatmawati.com/public_html/storage/profile_pictures/' . $ulasan->foto_profile;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath); // Remove the old file
            }
        }

        $fileProfile = $request->file('foto_profile');
        $profileFilename = time() . '.' . $fileProfile->getClientOriginalExtension();

        // Move the new file to the specified directory
        $fileProfile->move('/home/u174913696/domains/newprimagamafatmawati.com/public_html/storage/profile_pictures', $profileFilename);

        // Save the new file name to the database
        $ulasan->foto_profile = $profileFilename;
    }

    $ulasan->save(); // Save the updated review

    return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil diperbarui'); // Redirect back with success message
}


    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();
        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil dihapus');
    }
}
