@php
    $currentRoute = request()->route()->getName();
@endphp

{{-- Bottom Navigation - Mobile Only --}}
<nav class="fixed bottom-0 left-0 right-0 z-[99997] xl:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800"
    x-data="{ menuOpen: false }">

    {{-- ===== BOTTOM SHEET OVERLAY ===== --}}
    <div x-show="menuOpen"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="menuOpen = false"
        class="fixed inset-0 z-[99998] bg-gray-900/50"
        style="bottom: 64px;">
    </div>

    {{-- ===== BOTTOM SHEET PANEL ===== --}}
    <div x-show="menuOpen"
        x-transition:enter="transition-transform ease-out duration-300"
        x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition-transform ease-in duration-200"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="fixed left-0 right-0 z-[99999] bg-white dark:bg-gray-900 rounded-t-2xl shadow-xl"
        style="bottom: 64px;">

        {{-- Drag Handle --}}
        <div class="flex justify-center pt-3 pb-2">
            <div class="w-10 h-1 rounded-full bg-gray-300 dark:bg-gray-600"></div>
        </div>

        {{-- Menu Grid --}}
        <div class="px-6 pt-2 pb-6">
            <div class="grid grid-cols-4 gap-y-6 gap-x-2">

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex flex-col items-center gap-2 group"
                   @click="menuOpen = false">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-colors
                                {{ $currentRoute === 'admin.dashboard' ? 'bg-brand-50 dark:bg-brand-900/30' : 'bg-gray-100 dark:bg-gray-800' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             class="{{ $currentRoute === 'admin.dashboard' ? 'text-brand-500' : 'text-gray-500 dark:text-gray-400' }}">
                            <rect x="3" y="3" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.8"
                                fill="{{ $currentRoute === 'admin.dashboard' ? 'currentColor' : 'none' }}" fill-opacity="0.15"/>
                            <rect x="14" y="3" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.8"
                                fill="{{ $currentRoute === 'admin.dashboard' ? 'currentColor' : 'none' }}" fill-opacity="0.15"/>
                            <rect x="3" y="14" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.8"
                                fill="{{ $currentRoute === 'admin.dashboard' ? 'currentColor' : 'none' }}" fill-opacity="0.15"/>
                            <rect x="14" y="14" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.8"
                                fill="{{ $currentRoute === 'admin.dashboard' ? 'currentColor' : 'none' }}" fill-opacity="0.15"/>
                        </svg>
                    </div>
                    <span class="text-[11px] font-medium text-center
                                 {{ $currentRoute === 'admin.dashboard' ? 'text-brand-500' : 'text-gray-600 dark:text-gray-400' }}">
                        Dashboard
                    </span>
                </a>

                {{-- User --}}
                <a href="{{ route('admin.teachers.index') }}"
                   class="flex flex-col items-center gap-2 group"
                   @click="menuOpen = false">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-colors
                                {{ str_starts_with($currentRoute, 'admin.teachers') ? 'bg-brand-50 dark:bg-brand-900/30' : 'bg-gray-100 dark:bg-gray-800' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             class="{{ str_starts_with($currentRoute, 'admin.teachers') ? 'text-brand-500' : 'text-gray-500 dark:text-gray-400' }}">
                            <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.8"
                                fill="{{ str_starts_with($currentRoute, 'admin.teachers') ? 'currentColor' : 'none' }}" fill-opacity="0.15"/>
                            <path d="M4 20C4 17.7909 7.58172 16 12 16C16.4183 16 20 17.7909 20 20"
                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="text-[11px] font-medium text-center
                                 {{ str_starts_with($currentRoute, 'admin.teachers') ? 'text-brand-500' : 'text-gray-600 dark:text-gray-400' }}">
                        User
                    </span>
                </a>

                {{-- Kelas --}}
                <a href="{{ route('admin.classes.index') }}"
                   class="flex flex-col items-center gap-2 group"
                   @click="menuOpen = false">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-colors
                                {{ str_starts_with($currentRoute, 'admin.classes') ? 'bg-brand-50 dark:bg-brand-900/30' : 'bg-gray-100 dark:bg-gray-800' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             class="{{ str_starts_with($currentRoute, 'admin.classes') ? 'text-brand-500' : 'text-gray-500 dark:text-gray-400' }}">
                            <path d="M3 9.5L12 4L21 9.5V19C21 19.5523 20.5523 20 20 20H4C3.44772 20 3 19.5523 3 19V9.5Z"
                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                fill="{{ str_starts_with($currentRoute, 'admin.classes') ? 'currentColor' : 'none' }}" fill-opacity="0.15"/>
                            <path d="M9 20V14H15V20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="text-[11px] font-medium text-center
                                 {{ str_starts_with($currentRoute, 'admin.classes') ? 'text-brand-500' : 'text-gray-600 dark:text-gray-400' }}">
                        Kelas
                    </span>
                </a>

                {{-- Jadwal --}}
                <a href="{{ route('admin.schedule.index') }}"
                   class="flex flex-col items-center gap-2 group"
                   @click="menuOpen = false">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-colors
                                {{ str_starts_with($currentRoute, 'admin.schedule') ? 'bg-brand-50 dark:bg-brand-900/30' : 'bg-gray-100 dark:bg-gray-800' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             class="{{ str_starts_with($currentRoute, 'admin.schedule') ? 'text-brand-500' : 'text-gray-500 dark:text-gray-400' }}">
                            <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.8"
                                fill="{{ str_starts_with($currentRoute, 'admin.schedule') ? 'currentColor' : 'none' }}" fill-opacity="0.15"/>
                            <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="text-[11px] font-medium text-center
                                 {{ str_starts_with($currentRoute, 'admin.schedule') ? 'text-brand-500' : 'text-gray-600 dark:text-gray-400' }}">
                        Jadwal
                    </span>
                </a>

                {{-- Mapel --}}
                <a href="{{ route('admin.subjects.index') }}"
                   class="flex flex-col items-center gap-2 group"
                   @click="menuOpen = false">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-colors
                                {{ str_starts_with($currentRoute, 'admin.subjects') ? 'bg-brand-50 dark:bg-brand-900/30' : 'bg-gray-100 dark:bg-gray-800' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             class="{{ str_starts_with($currentRoute, 'admin.subjects') ? 'text-brand-500' : 'text-gray-500 dark:text-gray-400' }}">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"
                                stroke="currentColor" stroke-width="1.8"
                                fill="{{ str_starts_with($currentRoute, 'admin.subjects') ? 'currentColor' : 'none' }}" fill-opacity="0.15"/>
                        </svg>
                    </div>
                    <span class="text-[11px] font-medium text-center
                                 {{ str_starts_with($currentRoute, 'admin.subjects') ? 'text-brand-500' : 'text-gray-600 dark:text-gray-400' }}">
                        Mapel
                    </span>
                </a>

                {{-- Laporan --}}
                <a href="{{ route('admin.report.index') }}"
                   class="flex flex-col items-center gap-2 group"
                   @click="menuOpen = false">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-colors
                                {{ str_starts_with($currentRoute, 'admin.report') ? 'bg-brand-50 dark:bg-brand-900/30' : 'bg-gray-100 dark:bg-gray-800' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             class="{{ str_starts_with($currentRoute, 'admin.report') ? 'text-brand-500' : 'text-gray-500 dark:text-gray-400' }}">
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z"
                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                fill="{{ str_starts_with($currentRoute, 'admin.report') ? 'currentColor' : 'none' }}" fill-opacity="0.15"/>
                            <path d="M14 2V8H20M9 13H15M9 17H12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="text-[11px] font-medium text-center
                                 {{ str_starts_with($currentRoute, 'admin.report') ? 'text-brand-500' : 'text-gray-600 dark:text-gray-400' }}">
                        Laporan
                    </span>
                </a>

                {{-- Setting --}}
                <a href="{{ route('admin.settings') }}"
                   class="flex flex-col items-center gap-2 group"
                   @click="menuOpen = false">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-colors
                                {{ $currentRoute === 'admin.settings' ? 'bg-brand-50 dark:bg-brand-900/30' : 'bg-gray-100 dark:bg-gray-800' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             class="{{ $currentRoute === 'admin.settings' ? 'text-brand-500' : 'text-gray-500 dark:text-gray-400' }}">
                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"
                                fill="{{ $currentRoute === 'admin.settings' ? 'currentColor' : 'none' }}" fill-opacity="0.15"/>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"
                                stroke="currentColor" stroke-width="1.8"/>
                        </svg>
                    </div>
                    <span class="text-[11px] font-medium text-center
                                 {{ $currentRoute === 'admin.settings' ? 'text-brand-500' : 'text-gray-600 dark:text-gray-400' }}">
                        Setting
                    </span>
                </a>

                {{-- Lisensi --}}
                <a href="{{ route('admin.lisensi.index') }}"
                   class="flex flex-col items-center gap-2 group"
                   @click="menuOpen = false">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-colors
                                {{ $currentRoute === 'admin.lisensi.index' ? 'bg-brand-50 dark:bg-brand-900/30' : 'bg-gray-100 dark:bg-gray-800' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             class="{{ $currentRoute === 'admin.lisensi.index' ? 'text-brand-500' : 'text-gray-500 dark:text-gray-400' }}">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"
                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                fill="{{ $currentRoute === 'admin.lisensi.index' ? 'currentColor' : 'none' }}" fill-opacity="0.15"/>
                        </svg>
                    </div>
                    <span class="text-[11px] font-medium text-center
                                 {{ $currentRoute === 'admin.lisensi.index' ? 'text-brand-500' : 'text-gray-600 dark:text-gray-400' }}">
                        Lisensi
                    </span>
                </a>

            </div>

            {{-- Divider --}}
            <div class="my-4 border-t border-gray-100 dark:border-gray-800"></div>

            {{-- Keluar Aplikasi --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-between px-4 py-3.5 rounded-xl bg-red-50 dark:bg-red-900/20 text-red-500 dark:text-red-400 transition-colors hover:bg-red-100">
                    <div class="flex items-center gap-3">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <polyline points="16 17 21 12 16 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <line x1="21" y1="12" x2="9" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <span class="text-sm font-semibold">Keluar Aplikasi</span>
                    </div>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    {{-- ===== TAB BAR ===== --}}
    <div class="flex items-center justify-around h-16 px-2"
         style="padding-bottom: env(safe-area-inset-bottom);">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex flex-col items-center justify-center gap-1 flex-1 h-full transition-colors
                  {{ $currentRoute === 'admin.dashboard' ? 'text-brand-500' : 'text-gray-400 dark:text-gray-500' }}">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <rect x="3" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"
                    fill="{{ $currentRoute === 'admin.dashboard' ? 'currentColor' : 'none' }}" fill-opacity="0.2"/>
                <rect x="14" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"
                    fill="{{ $currentRoute === 'admin.dashboard' ? 'currentColor' : 'none' }}" fill-opacity="0.2"/>
                <rect x="3" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"
                    fill="{{ $currentRoute === 'admin.dashboard' ? 'currentColor' : 'none' }}" fill-opacity="0.2"/>
                <rect x="14" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"
                    fill="{{ $currentRoute === 'admin.dashboard' ? 'currentColor' : 'none' }}" fill-opacity="0.2"/>
            </svg>
            <span class="text-[10px] font-medium leading-none">Dashboard</span>
        </a>

        {{-- Kelas --}}
        <a href="{{ route('admin.classes.index') }}"
           class="flex flex-col items-center justify-center gap-1 flex-1 h-full transition-colors
                  {{ str_starts_with($currentRoute, 'admin.classes') ? 'text-brand-500' : 'text-gray-400 dark:text-gray-500' }}">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M3 9.5L12 4L21 9.5V19C21 19.5523 20.5523 20 20 20H4C3.44772 20 3 19.5523 3 19V9.5Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    fill="{{ str_starts_with($currentRoute, 'admin.classes') ? 'currentColor' : 'none' }}" fill-opacity="0.2"/>
                <path d="M9 20V14H15V20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="text-[10px] font-medium leading-none">Kelas</span>
        </a>

        {{-- Laporan --}}
        <a href="{{ route('admin.report.index') }}"
           class="flex flex-col items-center justify-center gap-1 flex-1 h-full transition-colors
                  {{ str_starts_with($currentRoute, 'admin.report') ? 'text-brand-500' : 'text-gray-400 dark:text-gray-500' }}">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    fill="{{ str_starts_with($currentRoute, 'admin.report') ? 'currentColor' : 'none' }}" fill-opacity="0.2"/>
                <path d="M14 2V8H20M9 13H15M9 17H12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span class="text-[10px] font-medium leading-none">Laporan</span>
        </a>

        {{-- Menu Toggle --}}
        <button
            @click="menuOpen = !menuOpen"
            class="flex flex-col items-center justify-center gap-1 flex-1 h-full transition-colors"
            :class="menuOpen ? 'text-brand-500' : 'text-gray-400 dark:text-gray-500'">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span class="text-[10px] font-medium leading-none">Menu</span>
        </button>

    </div>
</nav>