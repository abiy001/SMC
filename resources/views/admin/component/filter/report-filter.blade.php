<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Filter Rekapitulasi</h3>
    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
        Silakan pilih nama guru pada menu dropdown di atas untuk melihat <strong>Rapor Kinerja</strong>, 
        statistik kehadiran, dan detail aktivitas mengajar secara spesifik.
    </p>
    
    <div class="relative">
        <button id="dropdownButton" class="w-full md:w-96 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 text-left" type="button">
            <span id="selectedTeacher">Pilih Guru</span>
            <svg class="w-4 h-4 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        
        <div id="dropdownMenu" class="hidden absolute z-10 mt-2 w-full md:w-96 bg-white dark:bg-gray-700 rounded-lg shadow-lg border border-gray-200 dark:border-gray-600">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                @foreach($teachers as $teacher)
                <li>
                    <a href="#" onclick="selectTeacher({{ $teacher->id }}, '{{ $teacher->name }}', '{{ $teacher->subject }}'); return false;" 
                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="font-medium">{{ $teacher->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $teacher->subject }}</div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script>
    document.getElementById('dropdownButton').addEventListener('click', function() {
        const menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const button = document.getElementById('dropdownButton');
        const menu = document.getElementById('dropdownMenu');
        if (!button.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>