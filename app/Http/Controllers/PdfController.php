<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Import PDF facade

class PdfController extends Controller
{
    public function generatePdf()
    {
        // Data yang akan dikirim ke view PDF
        $data = [
            'title' => 'Nyoba doanggg',
            'content' => 'Ini adalah contoh laporan yang dibuat dalam format PDF menggunakan Laravel DomPDF.'
        ];

        // Menghasilkan file PDF dari view 'pdf_template'
        $pdf = PDF::loadView('pdf_template', $data);

        // Mengembalikan download file PDF
        return $pdf->download('laporan-pembayaran.pdf');
    }
}

