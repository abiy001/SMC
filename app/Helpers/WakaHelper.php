<?php 

namespace App\Helpers;

class WakaHelper{
    
  public static function items()
{
    return [
        [
            'name' => 'Dashboard',
            'path' => route('dashboard-waka'),
            'icon' => 'task'
        ],
        [
            'name' => 'Jadwal',
            'path' => route('jadwal'),
            'icon' => 'calendar'
        ],
        [
            'name' => 'Rekapitulasi',
            'icon' => 'tables',
            'subItems' => [
                [
                    'name' => 'Data Rekap',
                    'path' => route('waka.rekap'),
                ]
            ]
        ]
    ];
}
}

?>