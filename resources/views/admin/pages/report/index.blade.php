@extends('admin.layout-admin.app')

@section('title', 'Monitoring & Rekapitulasi Laporan')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Monitoring & Rekapitulasi</h1>
            <p class="text-gray-600 dark:text-gray-400">Analisa detail kinerja dan kedisiplinan guru berdasarkan laporan agen.</p>
        </div>

        <!-- Filter Section -->
        <div class="mb-8">
            @include('admin.component.filter.report-filter', ['teachers' => $teachers])
        </div>

        <!-- Teacher Performance Section -->
        <div id="teacherPerformance" class="mb-8 hidden">
            @include('admin.component.report.report-performance')
        </div>

        <!-- Latest Reports Feed -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                Feed Laporan Terbaru (Semua Guru)
            </h2>
            <div class="space-y-4">
                @foreach($reports as $report)
                    @include('admin.component.report.report-card', ['report' => $report])
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let selectedTeacherId = null;

    function selectTeacher(teacherId, teacherName, teacherSubject) {
        selectedTeacherId = teacherId;
        
        // Update selected teacher display
        document.getElementById('selectedTeacherName').textContent = teacherName;
        document.getElementById('selectedTeacherSubject').textContent = teacherSubject;
        
        // Show performance section
        document.getElementById('teacherPerformance').classList.remove('hidden');
        
        // Fetch teacher report data
        fetch(`/admin/report/teacher/${teacherId}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    updateTeacherPerformance(data);
                }
            })
            .catch(error => console.error('Error:', error));
    }
    
    function updateTeacherPerformance(data) {
        // Update statistics
        document.getElementById('statTotalHadir').textContent = data.statistics.total_hadir;
        document.getElementById('statTotalTidakHadir').textContent = data.statistics.total_tidak_hadir;
        document.getElementById('statTotalTerlambat').textContent = data.statistics.total_terlambat;
        document.getElementById('statRataKedisiplinan').textContent = data.statistics.rata_rata_kedisiplinan + '%';
        document.getElementById('statTotalLaporan').textContent = data.statistics.total_laporan;
        
        // Update activity table
        const tableBody = document.getElementById('activityTableBody');
        tableBody.innerHTML = '';
        
        data.reports.forEach(report => {
            const row = `
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="py-3 px-4">${report.date}</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 text-xs rounded-full ${report.status === 'On Time' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
                            ${report.time_in} (${report.status})
                        </span>
                    </td>
                    <td class="py-3 px-4 font-medium">${report.agenda}</td>
                    <td class="py-3 px-4 text-gray-600 dark:text-gray-400">${report.journal}</td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', row);
        });
    }
</script>
@endsection