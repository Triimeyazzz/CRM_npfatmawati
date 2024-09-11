<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {        
        $dataPisa = [
        'barData' => [
            'labels' => [
                "Indonesia (74)",
                "Brunei Darussalam (68)",
                "Singapore (1)",
                "Malaysia (35)",
                "Thailand (55)",
                "Philippines (53 literasi,54 Matematika,58 Sains)",
                "Vietnam (13)",
            ],
            'datasets' => [
                [
                    'label' => "Matematika",
                    'backgroundColor' => "#21409a",
                    'data' => [366, 442, 575, 409, 394, 355, 496],
                ],
                [
                    'label' => "Membaca",
                    'backgroundColor' => "#7b1fa1",
                    'data' => [359, 492, 534, 338, 379, 374, 462],
                ],
                [
                    'label' => "Sains",
                    'backgroundColor' => "#ffc007",
                    'data' => [383, 446, 561, 416, 409, 356, 472],
                ],
            ],
        ],
        'description' => [
            [
                'title' => "Kualitas Pendidikan",
                'text' => "Tantangan dalam mencapai standar pendidikan yang konsisten dan berkualitas di seluruh negeri dapat mempengaruhi hasil akademik."
            ],
            [
                'title' => "Kurikulum dan Metode Pembelajaran",
                'text' => "Kesenjangan dalam implementasi kurikulum dan metode pembelajaran yang mempromosikan pemahaman mendalam."
            ],
            [
                'title' => "Pemahaman Bahasa dan Budaya",
                'text' => "Penggunaan bahasa dalam pengajaran dan ujian bisa menjadi hambatan bagi siswa."
            ],
            [
                'title' => "Kesejahteraan dan Akses",
                'text' => "Faktor latar belakang ekonomi, sosial, dan geografis juga dapat mempengaruhi ketersediaan akses."
            ],
            [
                'title' => "Fokus pada Tes Standar",
                'text' => "Sistem pendidikan yang mungkin lebih terfokus pada tes standar daripada pengembangan keterampilan."
            ]
        ]
    ];

    $contentData = [
        [
            'id' => 1,
            'title' => "Mengapa Harus Belajar di New Primagama Fatmawati",
            'imgSrc' => "/images/buku.png",
            'imgAlt' => "Robot Zenius",
            'heading' => "Tes Minat Bakat (Tes Diagnostik)",
            'text' => "Tes yang dilakukan untuk memastikan putra/i kita belajar sesuai dengan gaya dan modalitas belajarnya masing-masing.",
            'aosImage' => "fade-right",
            'aosText' => "fade-left",
        ],
        [
            'id'=> 2,
            'imgSrc'=> "/images/Generasiemas.png",
            'imgAlt'=> "Generasi Emas",
            'heading'=> "Akses Premium ke zenius.net",
            'text'=> "Siswa dapat mengakses puluhan ribu v'id'eo materi, latihan soal, dan pembahasan.",
            'aosImage'=> "fade-left",
            'aosText'=> "fade-right",
        ],
        [
            'id'=> 3,
            'imgSrc'=> "/images/Generasiemas.png",
            'imgAlt'=> "Generasi Emas",
            'heading'=> "Gratis Konsultasi Setiap Hari",
            'text'=> "Siswa yang terkendala untuk memahami materi ataupun tugas yang diberikan oleh guru di sekolah, dapat meminta sesi konsultasi secara gratis.",
            'aosImage'=> "fade-left",
            'aosText'=> "fade-right",
        ],
        
        [
            'id'=> 5,
            'imgSrc'=> "/images/Generasiemas.png",
            'imgAlt'=> "Generasi Emas",
            'heading'=> "Buku dan Proset Super Lengkap",
            'text'=> "Buku fase, master book, smart exercise, dan proset yang sudah disesuaikan dengan kurikulum pemerintah dan mudah dipahami.",
            'aosImage'=> "fade-left",
            'aosText'=> "fade-right",
        ],
        [
            'id'=> 6,
            'imgSrc'=> "/images/Generasiemas.png",
            'imgAlt'=> "Generasi Emas",
            'heading'=> "Professional Tutor",
            'text'=> "Disiapkan tim pengajar yang handal, terlatih, berpengalaman, dan mampu menyampaikan materi dengan cara yang asik, interaktif dan menyenangkan.",
            'aosImage'=> "fade-left",
            'aosText'=> "fade-right",
        ],
        [
            'id'=> 7,
            'imgSrc'=> "/images/Generasiemas.png",
            'imgAlt'=> "Generasi Emas",
            'heading'=> "One Day Before Exam",
            'text'=> "Program Super Intensif masuk setiap hari selama persiapan ATS, AAS, ASTS, ASAT, dan UTBK sampai Ujian Mandiri 2025 dilengkapi dengan Try Out dan drilling ribuan soal secara berkala.",
            'aosImage'=> "fade-left",
            'aosText'=> "fade-right",
        ],
        [
            'id'=> 8,
            'imgSrc'=> "/images/Generasiemas.png",
            'imgAlt'=> "Generasi Emas",
            'heading'=> "Kelas Motivasi Juara dan Self Improvement",
            'text'=> "Kelas untuk membekali siswa/i dalam menghadapi ujian akhir dengan mental positif dan motivasi yang kuat.",
            'aosImage'=> "fade-left",
            'aosText'=> "fade-right",
        ],
        [
            'id'=> 9,
            'imgSrc'=> "/images/Generasiemas.png",
            'imgAlt'=> "Generasi Emas",
            'heading'=> "Sarana dan Prasarana Belajar yang Baik",
            'text'=> "Kelas yang kondusif (maksimal 12 siswa/kelas) dan nyaman yang sudah dilengkapi dengan AC, TV, whiteboard, dan CCTV.",
            'aosImage'=> "fade-left",
            'aosText'=> "fade-right",
        ],
        [
            'id'=> 10,
            'imgSrc'=> "/images/Generasiemas.png",
            'imgAlt'=> "Generasi Emas",
            'heading'=> "Komunitas Zen-Sport dan Ekskul English",
            'text'=> "Zen-Sport diadakan setiap bulannya agar siswa/i dapat merefresh otak setelah belajar. Ekskul Bahasa Inggris diadakan untuk melatih basic skills siswa/i.",
            'aosImage'=> "fade-left",
            'aosText'=> "fade-right",
        ],
        [
            'id'=> 11,
            'imgSrc'=> "/images/Generasiemas.png",
            'imgAlt'=> "Generasi Emas",
            'heading'=> "Analisa Nilai Raport",
            'text'=> "Sistem konsultasi terpadu untuk menganalisa tingkat keberhasilan siswa dalam proses belajar ke terutama tingkat selanjutnya,terutama untuk memaksimalkan peluang jalur SNBP 2025.",
            'aosImage'=> "fade-left",
            'aosText'=> "fade-right",
        ],
    ];

    $komponenBelajar = [
        [
            'id' => 1,
            'imgSrc' => '/images/Fundamental.png',
            'title' => 'Komponen Fundamental Learning',
            'imgAlt' => 'Zenius Center',
        ],
        [
            'id' => 2,
            'imgSrc' => '/images/layanan/layanan2.png',
            'title' => 'Kelas Offline Yang Interaktif dan Nyaman',
            'imgAlt' => 'Zenius Center',
        ],
        [
            'id'=> 3,
            'imgSrc'=> "/images/layanan/layanan3.png",
            'title'=> "Pendalaman materi pelajaran sekolah",
            'imgAlt'=> "Zenius Center",
            
        ],
        [
            'id'=> 4,
            'imgSrc'=> "/images/layanan/layanan4.png",
            'imgAlt'=> "Layanan 4",
            'title'=> "Akses ke platform digital Zenius",
            
        ],
        [
            'id'=> 5,
            'imgSrc'=> "/images/layanan/layanan5.png",
            'imgAlt'=> "Layanan 5",
            'title'=> "Buku pelajaran Kurikulum Merdeka",
            
        ],
        [
            'id'=> 6,
            'imgSrc'=> "/images/layanan/layanan6.png",
            'imgAlt'=> "Layanan 6",
            'title'=> "Ulas Cerdas Model",
            
        ],
        [
            'id'=> 7,
            'imgSrc'=> "/images/layanan/layanan6.png",
            'imgAlt'=> "Layanan 6",
            'title'=> "ZenCore",
            
        ],
        [
            'id'=> 8,
            'imgSrc'=> "/images/layanan/layanan6.png",
            'imgAlt'=> "Layanan 6",
            'title'=> "TryOut berkala secara daring",
            
        ],[
            'id'=> 9,
            'imgSrc'=> "/images/layanan/layanan6.png",
            'imgAlt'=> "Layanan 6",
            'title'=> "Analisis Prestasi Rapor",
            
        ],[
            'id'=> 10,
            'imgSrc'=> "/images/layanan/layanan6.png",
            'imgAlt'=> "Layanan 6",
            'title'=> "Tes Psiko-Kognitif",
            
        ],[
            'id'=> 11,
            'imgSrc'=> "/images/layanan/layanan6.png",
            'imgAlt'=> "Layanan 6",
            'title'=> "Buku HAJAR (Bahan Belajar)",
            
        ],[
            'id'=> 12,
            'imgSrc'=> "/images/layanan/layanan6.png",
            'imgAlt'=> "Layanan 6",
            'title'=> "TryOut persiapan SNBT online",
            
        ],[
            'id'=> 13,
            'imgSrc'=> "/images/layanan/layanan6.png",
            'imgAlt'=> "Layanan 6",
            'title'=> "Konsultasi belajar",
            
        ],[
            'id'=> 14,
            'imgSrc'=> "/images/layanan/layanan6.png",
            'imgAlt'=> "Layanan 6",
            'title'=> "Pendampingan persiapan tes dan ujian",
            
        ],[
            'id'=> 15,
            'imgSrc'=> "/images/layanan/layanan6.png",
            'imgAlt'=> "Layanan 6",
            'title'=> "Persiapan kampus impian",
            
        ],
    ];
        return view('home.index',compact('dataPisa', 'contentData', 'komponenBelajar')); ;
    }

    public function about()
    {
        return view('home.about');
    }
}
