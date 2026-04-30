<div class="bg-white p-6 rounded-2xl shadow">
    
    <h3 class="font-semibold text-gray-800 mb-4">Fitur Premium</h3>

  <ul class="space-y-3 text-gray-600">
    @foreach([
        'Unlimited Siswa & Guru',
        'Akses Penuh Laporan Historis',
        'Export PDF & Excel Tanpa Watermark',
        'Prioritas Support 24/7',
        'Update Fitur Otomatis',
        'Custom KOP Surat & Logo Sekolah'
    ] as $fitur)

    <li class="flex items-center gap-2">
        <!-- CHECK ICON -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 13l4 4L19 7" />
        </svg>
        {{ $fitur }}
    </li>

    @endforeach
</ul>

</div>