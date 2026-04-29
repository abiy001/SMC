<?php

namespace App\Http\Controllers;

use App\Models\ReportLeason;
use Illuminate\Http\Request;

class ReportLeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Data dummy untuk contoh
        $teachers = [
            (object) ['id' => 1, 'name' => 'Pak Budi Hartono', 'subject' => 'Matematika', 'attendance' => 100],
            (object) ['id' => 2, 'name' => 'Ibu Siti Aminah', 'subject' => 'Bahasa Indonesia', 'attendance' => 95],
            (object) ['id' => 3, 'name' => 'Pak Ahmad Fauzi', 'subject' => 'Fisika', 'attendance' => 98],
            (object) ['id' => 4, 'name' => 'Ibu Dewi Kartika', 'subject' => 'Kimia', 'attendance' => 92],
            (object) ['id' => 5, 'name' => 'Pak Eko Prasetyo', 'subject' => 'Biologi', 'attendance' => 88],
        ];

        $reports = [
            (object) [
                'id' => 1,
                'teacher_name' => 'Pak Budi Hartono',
                'subject' => 'Matematika',
                'attendance' => '100% Hadir',
                'reporter' => 'Andi Saputra (XII IPA 1)',
                'agenda' => 'Persamaan Linear Tiga Variabel',
                'journal' => 'Pak Budi masuk tepat waktu jam 07.00. Beliau menjelaskan materi dengan sangat detail di papan tulis. Suasana kelas kondusif, semua memperhatikan.',
                'date' => '2024-01-15',
                'time_in' => '07:00',
                'status' => 'On Time'
            ],
            (object) [
                'id' => 2,
                'teacher_name' => 'Pak Budi Hartono',
                'subject' => 'Matematika',
                'attendance' => '100% Hadir',
                'reporter' => 'Siti Nurhaliza (XII IPA 1)',
                'agenda' => 'Persamaan Linear Dua Variabel',
                'journal' => 'Pelajaran berlangsung interaktif. Pak Budi memberikan latihan soal dan membahasnya bersama-sama.',
                'date' => '2024-01-14',
                'time_in' => '07:05',
                'status' => 'Late'
            ],
            (object) [
                'id' => 3,
                'teacher_name' => 'Ibu Siti Aminah',
                'subject' => 'Bahasa Indonesia',
                'attendance' => '95% Hadir',
                'reporter' => 'Budi Santoso (XII IPA 2)',
                'agenda' => 'Menganalisis Unsur Kebahasaan Teks Negosiasi',
                'journal' => 'Ibu Siti masuk tepat waktu. Beliau menjelaskan materi dengan contoh-contoh yang mudah dipahami.',
                'date' => '2024-01-15',
                'time_in' => '07:00',
                'status' => 'On Time'
            ],
            (object) [
                'id' => 4,
                'teacher_name' => 'Pak Ahmad Fauzi',
                'subject' => 'Fisika',
                'attendance' => '98% Hadir',
                'reporter' => 'Rina Febrianti (XII IPA 3)',
                'agenda' => 'Hukum Newton tentang Gerak',
                'journal' => 'Pak Fauzi melakukan demonstrasi praktikum. Siswa sangat antusias mengikuti pembelajaran.',
                'date' => '2024-01-15',
                'time_in' => '07:10',
                'status' => 'Late'
            ],
        ];

        return view('admin.pages.report.index', compact('teachers', 'reports'));
    }

    public function getTeacherReport($id)
    {
        // Data detail per guru (dummy)
        $teacherReports = [
            1 => [
                'teacher' => (object) ['id' => 1, 'name' => 'Pak Budi Hartono', 'subject' => 'Matematika', 'attendance' => 100],
                'reports' => [
                    (object) [
                        'date' => '2024-01-15',
                        'agenda' => 'Persamaan Linear Tiga Variabel',
                        'journal' => 'Pak Budi masuk tepat waktu jam 07.00. Beliau menjelaskan materi dengan sangat detail di papan tulis.',
                        'time_in' => '07:00',
                        'status' => 'On Time'
                    ],
                    (object) [
                        'date' => '2024-01-14',
                        'agenda' => 'Persamaan Linear Dua Variabel',
                        'journal' => 'Pelajaran berlangsung interaktif dengan diskusi kelompok.',
                        'time_in' => '07:05',
                        'status' => 'Late'
                    ],
                ],
                'statistics' => [
                    'total_hadir' => 28,
                    'total_tidak_hadir' => 0,
                    'total_terlambat' => 2,
                    'rata_rata_kedisiplinan' => 98.5,
                    'total_laporan' => 30,
                ]
            ],
            2 => [
                'teacher' => (object) ['id' => 2, 'name' => 'Ibu Siti Aminah', 'subject' => 'Bahasa Indonesia', 'attendance' => 95],
                'reports' => [
                    (object) [
                        'date' => '2024-01-15',
                        'agenda' => 'Menganalisis Unsur Kebahasaan Teks Negosiasi',
                        'journal' => 'Ibu Siti menjelaskan dengan sangat jelas dan memberikan contoh-contoh konkret.',
                        'time_in' => '07:00',
                        'status' => 'On Time'
                    ],
                ],
                'statistics' => [
                    'total_hadir' => 27,
                    'total_tidak_hadir' => 1,
                    'total_terlambat' => 1,
                    'rata_rata_kedisiplinan' => 96.2,
                    'total_laporan' => 28,
                ]
            ]
        ];

        return response()->json($teacherReports[$id] ?? null);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportLeason $reportLeason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportLeason $reportLeason)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReportLeason $reportLeason)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportLeason $reportLeason)
    {
        //
    }
}