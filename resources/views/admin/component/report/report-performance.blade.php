<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
        <h3 class="text-xl font-bold text-white">Rapor Kinerja Guru</h3>
        <p class="text-blue-100 mt-1">
            <span id="selectedTeacherName">-</span> • 
            <span id="selectedTeacherSubject" class="text-sm">-</span>
        </p>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 p-6 border-b border-gray-200 dark:border-gray-700">
        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-green-600 dark:text-green-400" id="statTotalHadir">0</div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Hadir</div>
        </div>
        <div class="bg-red-50 dark:bg-red-900/20 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-red-600 dark:text-red-400" id="statTotalTidakHadir">0</div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Tidak Hadir</div>
        </div>
        <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400" id="statTotalTerlambat">0</div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Terlambat</div>
        </div>
        <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400" id="statRataKedisiplinan">0%</div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Rata-rata Kedisiplinan</div>
        </div>
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400" id="statTotalLaporan">0</div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Laporan</div>
        </div>
    </div>
    
    <!-- Activity Table -->
    <div class="p-6">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Detail Aktivitas Mengajar
        </h4>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jam Masuk</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Agenda</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jurnal</th>
                    </tr>
                </thead>
                <tbody id="activityTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-500 dark:text-gray-400">
                            Pilih guru terlebih dahulu untuk melihat detail aktivitas
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>