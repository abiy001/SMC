<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-300">
    <div class="p-6">
        <!-- Header Card -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
            <div class="flex items-center space-x-3 mb-3 md:mb-0">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $report->subject }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ $report->teacher_name }}
                        </span>
                    </p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                    {{ $report->attendance }}
                </span>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $report->date }}</span>
            </div>
        </div>
        
        <!-- Reporter Info -->
        <div class="mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Pelapor: {{ $report->reporter }}
            </div>
        </div>
        
        <!-- Agenda -->
        <div class="mb-4">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">AGENDA</span>
            </div>
            <p class="text-gray-800 dark:text-gray-200 pl-7">{{ $report->agenda }}</p>
        </div>
        
        <!-- Journal -->
        <div>
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">JURNAL</span>
            </div>
            <p class="text-gray-600 dark:text-gray-400 pl-7">{{ $report->journal }}</p>
        </div>
        
        <!-- Status Badge -->
        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-end">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $report->status == 'On Time' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $report->time_in }} ({{ $report->status }})
                </span>
            </div>
        </div>
    </div>
</div>