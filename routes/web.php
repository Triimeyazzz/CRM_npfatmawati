<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TryOutController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\CicilanController;
use App\Http\Controllers\AdminUlasanController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AbsensiController;

use App\Http\Controllers\KirimEmailController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Auth\AuthenticatedSessionController as AuthAuthenticatedSessionController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('login', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'login']);
Route::post('logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

Route::get('register', [AuthenticatedSessionController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthenticatedSessionController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::post('/events', [EventController::class, 'store']);
    Route::get('/events', [EventController::class, 'index']);
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/{user}/show', [UserController::class, 'show'])->name('users.show');

    Route::prefix('admin/siswa')->name('adminsiswa.')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('index'); // Menampilkan daftar siswa
        Route::get('/create', [SiswaController::class, 'create'])->name('create'); // Menampilkan form tambah siswa
        Route::post('/', [SiswaController::class, 'store'])->name('store'); // Menyimpan data siswa baru
        Route::get('/{id}/edit', [SiswaController::class, 'edit'])->name('edit'); // Menampilkan form edit siswa
        Route::put('/{siswa}', [SiswaController::class, 'update'])->name('update'); // Memperbarui data siswa
        Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('destroy'); // Menghapus data siswa
        Route::get('/{siswa}', [SiswaController::class, 'show'])->name('show'); // Menampilkan detail siswa
        Route::get('/{id}/cetakqr', [SiswaController::class, 'cetakqr'])->name('cetakqr'); // Mencetak QR code
    });
    Route::get('adminsiswa/qrcode/{id}', [SiswaController::class, 'cetakqr'])->name('adminsiswa.qrcode');
    Route::get('adminsiswa/qrcode/download/{id}', [SiswaController::class, 'downloadQrCode'])->name('adminsiswa.qrcode.download');

    Route::get('tryout', [TryOutController::class, 'index'])->name('tryout.index');
    Route::get('tryout/{siswa}/progress', [TryOutController::class, 'progress'])->name('tryout.progress');

    Route::get('tryout/{siswa}/create', [TryOutController::class, 'create'])->name('tryout.create');
    Route::post('tryout/{siswa}', [TryOutController::class, 'store'])->name('tryout.store');
        Route::delete('/tryout/{id}', [TryOutController::class, 'destroy'])->name('tryout.destroy');
    Route::get('/tryout/backup', [TryOutController::class, 'backup'])->name('tryout.backup');


Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/pembayaran/{pembayaran}', [PembayaranController::class, 'show'])->name('pembayaran.show');
Route::post('/pembayaran/{pembayaran}/bayar', [PembayaranController::class, 'bayarCicilan'])->name('pembayaran.bayarCicilan');
Route::get('/pembayaran/financial-summary', [PembayaranController::class, 'financialSummary'])->name('pembayaran.financialSummary');
Route::delete('/pembayaran/cicilan/{id}', [PembayaranController::class, 'destroyCicilan'])->name('pembayaran.cicilan.destroy');
Route::post('/pembayaran/{id}/cancel', [PembayaranController::class, 'cancel'])->name('pembayaran.cancel');
Route::post('/pembayaran/{id}/cancel-new', [PembayaranController::class, 'cancelNew'])->name('pembayaran.cancelNew');

Route::get('kirim-email', KirimEmailController::class)->name('kirimEmail');


Route::get('/cicilan', [CicilanController::class, 'index'])->name('cicilan.index');
Route::post('/cicilan', [CicilanController::class, 'store'])->name('cicilan.store');
Route::get('/cicilan/{cicilan}', [CicilanController::class, 'show'])->name('cicilan.show');
Route::put('/cicilan/{cicilan}', [CicilanController::class, 'update'])->name('cicilan.update');
Route::delete('/cicilan/{cicilan}', [CicilanController::class, 'destroy'])->name('cicilan.destroy');

Route::resource('ulasan', AdminUlasanController::class);

// Admin routes for managing messages
Route::get('/admin/messages', [MessageController::class, 'indexAdmin'])->name('messages.index');
Route::get('/admin/messages/conversation/{receiver_id}', [MessageController::class, 'showConversation'])->name('messages.conversation');
Route::post('/admin/messages', [MessageController::class, 'store'])->name('messages.store');
Route::post('/admin/messages/send/{receiver_id}', [MessageController::class, 'store'])->name('messages.send');



Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');
Route::get('/absensi/scan', [AbsensiController::class, 'scan'])->name('absensi.scan');
Route::post('/absensi/scan', [AbsensiController::class, 'scanQr'])->name('absensi.scanQr');


Route::any('kirimEmail', KirimEmailController::class)->name('kirimemail');

Route::get('/generate-pdf', [PdfController::class, 'generatePdf'])->name('exportPdf');


Route::get('absensi/export/excel', [AbsensiController::class, 'exportExcel'])->name('absensi.export.excel');
Route::get('absensi/export/pdf', [AbsensiController::class, 'exportPDF'])->name('absensi.export.pdf');

});

require __DIR__.'/auth.php';
