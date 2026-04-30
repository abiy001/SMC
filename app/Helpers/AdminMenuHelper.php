<?php

namespace App\Helpers;

class AdminMenuHelper
{
    public static function menu()
    {
        return [
            [
                'title' => 'Admin',
                'items' => [

                    [
                        'name' => 'Dashboard',
                        'icon' => 'dashboard',
                        'route' => 'admin.dashboard',
                    ],
                    
                    ['name' => 'user',
                        'icon' => 'user-profile',
                         'subItems' => [
                            [
                                'name' => 'Waka',
                                'icon' => 'user-profile',
                                'route' => 'admin.waka.index',
                            ],

                            [
                                'name' => 'Siswa',
                                'icon' => 'user-profile',
                                'route' => 'admin.students.index',
                            ],

                            [
                                'name' => 'Guru',
                                'icon' => 'user-profile',
                                'route' => 'admin.teachers.index',
                            ],
                         ]

                    ],
                  
                    [
                        'name' => 'Kelas',
                        'icon' => 'tables',
                        'route' => 'admin.classes.index',
                    ],

                    [
                        'name' => 'Akademik',
                        'icon' => 'forms',
                        'subItems' => [
                            [
                                'name' => 'Mapel',
                                'route' => 'admin.subjects.index'
                            ],
                            [
                                'name' => 'Jadwal',
                                'route' => 'admin.schedule.index'
                            ],
                        ]
                    ],
                    [
                        
                        'name' => 'Lisensi',
                        'icon' => 'tables',
                        'route' => 'admin.lisensi.index',
                    ],
                    [
                        
                        'name' => 'Report',
                        'icon' => 'tables',
                        'route' => 'admin.report.index',
                    ],
                ]
            ]
        ];
    }

    public static function isActive($route)
    {
        return request()->routeIs($route . '*');
    }
}