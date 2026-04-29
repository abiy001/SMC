{{-- resources/views/admin/pages/users/classes/index.blade.php --}}
@extends('admin.layout-admin.app')

@section('content')
<div x-data="{
    activeLevel: 'SMA',
    activeGrade: 'Semua',
    search: '',
    showModal: false,
    editMode: false,
    editId: null,
    form: { name: '', level: 'SMA', grade: 'X', capacity: 36 },
    
    grades() {
        const map = { SD: ['Semua','Kelas I','Kelas II','Kelas III','Kelas IV','Kelas V','Kelas VI'], SMP: ['Semua','Kelas VII','Kelas VIII','Kelas IX'], SMA: ['Semua','Kelas X','Kelas XI','Kelas XII'] };
        return map[this.activeLevel] || ['Semua'];
    },
    gradeOptions() {
        const map = { SD: ['I','II','III','IV','V','VI'], SMP: ['VII','VIII','IX'], SMA: ['X','XI','XII'] };
        return map[this.form.level] || [];
    },
    openCreate() {
        this.editMode = false;
        this.editId = null;
        this.form = { name: '', level: this.activeLevel, grade: 'X', capacity: 36 };
        this.showModal = true;
    },
    openEdit(id, name, level, grade, capacity) {
        this.editMode = true;
        this.editId = id;
        this.form = { name, level, grade, capacity };
        this.showModal = true;
    }
}" class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Manajemen Kelas</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Atur daftar kelas dan rombongan belajar.</p>
        </div>
        <button @click="openCreate()"
            class="inline-flex items-center gap-2 rounded-xl bg-brand-500 px-5 py-2.5 text-sm font-semibold text-white hover:bg-brand-600 transition-colors shadow-sm">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
            Tambah Kelas
        </button>
    </div>

    @if(session('success'))
        <div class="rounded-xl bg-green-50 px-4 py-3 text-sm text-green-700 dark:bg-green-500/15 dark:text-green-400 border border-green-100 dark:border-green-500/20">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- Level Tabs --}}
    <div class="flex gap-2">
        @foreach(['SD / MI', 'SMP / MTS', 'SMA / SMK'] as $label)
            @php $key = explode(' ', $label)[0]; @endphp
            <button @click="activeLevel = '{{ $key }}'; activeGrade = 'Semua'"
                class="px-5 py-2 rounded-xl text-sm font-medium transition-all duration-200 border"
                :class="activeLevel === '{{ $key }}'
                    ? 'bg-brand-500 text-white border-brand-500 shadow-sm'
                    : 'bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-700 hover:border-brand-300'">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Search + Grade Filter --}}
    <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 px-4 py-3">
        {{-- Search --}}
        <div class="relative flex-shrink-0">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                    <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            <input type="text" x-model="search" placeholder="Cari kelas..."
                class="pl-9 pr-4 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:outline-none focus:border-brand-400 w-48" />
        </div>

        {{-- Divider --}}
        <div class="hidden sm:block w-px h-6 bg-gray-200 dark:bg-gray-700"></div>

        {{-- Grade Buttons --}}
        <div class="flex flex-wrap gap-2">
            <template x-for="grade in grades()" :key="grade">
                <button @click="activeGrade = grade"
                    class="px-3.5 py-1.5 rounded-lg text-sm font-medium transition-all duration-150"
                    :class="activeGrade === grade
                        ? 'bg-brand-50 text-brand-600 dark:bg-brand-900/30 dark:text-brand-400 font-semibold'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-700'">
                    <span x-text="grade"></span>
                </button>
            </template>
        </div>
    </div>

    {{-- Class Grid --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        @forelse($classes as $class)
            <div
                x-show="
                    activeLevel === '{{ $class->level }}' &&
                    (activeGrade === 'Semua' || activeGrade === ('Kelas ' + '{{ $class->grade }}')) &&
                    (search === '' || '{{ strtolower($class->name) }}'.includes(search.toLowerCase()))
                "
                class="relative group rounded-2xl overflow-hidden cursor-pointer transition-transform duration-200 hover:-translate-y-1 hover:shadow-xl"
                style="background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);">

                {{-- Level Badge --}}
                <div class="absolute top-3 left-3 z-10">
                    <span class="text-[10px] font-semibold text-white/90 bg-white/20 backdrop-blur-sm px-2.5 py-1 rounded-full">
                        Level {{ $class->grade }}
                    </span>
                </div>

                {{-- Action Buttons --}}
                <div class="absolute top-2 right-2 z-10 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                    <button
                        @click="openEdit('{{ $class->id }}', '{{ $class->name }}', '{{ $class->level }}', '{{ $class->grade }}', {{ $class->capacity }})"
                        class="w-7 h-7 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center hover:bg-white/40 transition-colors">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST"
                          onsubmit="return confirm('Hapus kelas {{ $class->name }}?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="w-7 h-7 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center hover:bg-red-500/60 transition-colors">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                <polyline points="3 6 5 6 21 6" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                                <path d="M10 11v6M14 11v6" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- Card Content --}}
                <div class="px-4 pt-12 pb-3 flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mb-3">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                            <path d="M3 9.5L12 4L21 9.5V19C21 19.5523 20.5523 20 20 20H4C3.44772 20 3 19.5523 3 19V9.5Z"
                                stroke="white" stroke-width="1.8" fill="rgba(255,255,255,0.25)" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 20V14H15V20" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">{{ $class->name }}</h3>
                </div>

                {{-- Footer --}}
                <div class="mx-3 mb-3 rounded-xl bg-black/20 px-4 py-2 flex items-center justify-center gap-2">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="9" cy="7" r="4" stroke="white" stroke-width="2"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span class="text-sm font-semibold text-white">{{ $class->capacity }} Siswa</span>
                </div>
            </div>
        @empty
            <div class="col-span-5 py-16 text-center text-gray-400">
                <svg class="mx-auto mb-3 text-gray-300" width="48" height="48" viewBox="0 0 24 24" fill="none">
                    <path d="M3 9.5L12 4L21 9.5V19C21 19.5523 20.5523 20 20 20H4C3.44772 20 3 19.5523 3 19V9.5Z" stroke="currentColor" stroke-width="1.5"/>
                </svg>
                <p class="text-sm">Belum ada data kelas.</p>
            </div>
        @endforelse
    </div>

    {{-- ===== MODAL TAMBAH / EDIT ===== --}}
    <div x-show="showModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[99999] flex items-center justify-center p-4"
        style="display: none;">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" @click="showModal = false"></div>

        {{-- Modal Panel --}}
        <div class="relative w-full max-w-md bg-white dark:bg-gray-900 rounded-2xl shadow-2xl z-10"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-100 dark:border-gray-800">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white"
                    x-text="editMode ? 'Edit Kelas' : 'Tambah Kelas Baru'"></h2>
                <button @click="showModal = false"
                    class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>

            {{-- Create Form --}}
            <form x-show="!editMode" action="{{ route('admin.classes.store') }}" method="POST">
                @csrf
                <div class="px-6 py-5 space-y-5">

                    {{-- Jenjang --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenjang Sekolah</label>
                        <div class="flex gap-2">
                            @foreach(['SD', 'SMP', 'SMA'] as $lvl)
                                <button type="button" @click="form.level = '{{ $lvl }}'; form.grade = gradeOptions()[0]"
                                    class="flex-1 py-2 rounded-xl text-sm font-semibold border-2 transition-all duration-150"
                                    :class="form.level === '{{ $lvl }}'
                                        ? 'bg-gray-900 dark:bg-white text-white dark:text-gray-900 border-gray-900 dark:border-white'
                                        : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-700'">
                                    {{ $lvl }}
                                </button>
                            @endforeach
                        </div>
                        <input type="hidden" name="level" :value="form.level">
                    </div>

                    {{-- Tingkat --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Tingkat Kelas (<span x-text="form.level"></span>)
                        </label>
                        <select name="grade" x-model="form.grade"
                            class="w-full h-11 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-brand-400">
                            <template x-for="g in gradeOptions()" :key="g">
                                <option :value="g" x-text="'Kelas ' + g" :selected="form.grade === g"></option>
                            </template>
                        </select>
                    </div>

                    {{-- Nama Kelas --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Kelas Lengkap</label>
                        <input type="text" name="name" x-model="form.name" placeholder="Contoh: X-5"
                            class="w-full h-11 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-brand-400 @error('name') border-red-400 @enderror" />
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kapasitas --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kapasitas Siswa</label>
                        <input type="number" name="capacity" x-model="form.capacity" min="1" max="100"
                            class="w-full h-11 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-brand-400" />
                    </div>
                </div>

                <div class="px-6 pb-6">
                    <button type="submit"
                        class="w-full py-3 rounded-xl bg-brand-500 text-white font-semibold text-sm hover:bg-brand-600 transition-colors">
                        Simpan Data Kelas
                    </button>
                </div>
            </form>

            {{-- Edit Form --}}
            <form x-show="editMode" :action="`/admin/classes/${editId}`" method="POST">
                @csrf
                @method('PUT')
                <div class="px-6 py-5 space-y-5">

                    {{-- Jenjang --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenjang Sekolah</label>
                        <div class="flex gap-2">
                            @foreach(['SD', 'SMP', 'SMA'] as $lvl)
                                <button type="button" @click="form.level = '{{ $lvl }}'"
                                    class="flex-1 py-2 rounded-xl text-sm font-semibold border-2 transition-all duration-150"
                                    :class="form.level === '{{ $lvl }}'
                                        ? 'bg-gray-900 dark:bg-white text-white dark:text-gray-900 border-gray-900 dark:border-white'
                                        : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-700'">
                                    {{ $lvl }}
                                </button>
                            @endforeach
                        </div>
                        <input type="hidden" name="level" :value="form.level">
                    </div>

                    {{-- Tingkat --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Tingkat Kelas (<span x-text="form.level"></span>)
                        </label>
                        <select name="grade" x-model="form.grade"
                            class="w-full h-11 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-brand-400">
                            <template x-for="g in gradeOptions()" :key="g">
                                <option :value="g" x-text="'Kelas ' + g" :selected="form.grade === g"></option>
                            </template>
                        </select>
                    </div>

                    {{-- Nama --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Kelas Lengkap</label>
                        <input type="text" name="name" x-model="form.name"
                            class="w-full h-11 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-brand-400" />
                    </div>

                    {{-- Kapasitas --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kapasitas Siswa</label>
                        <input type="number" name="capacity" x-model="form.capacity" min="1" max="100"
                            class="w-full h-11 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-brand-400" />
                    </div>
                </div>

                <div class="px-6 pb-6">
                    <button type="submit"
                        class="w-full py-3 rounded-xl bg-brand-500 text-white font-semibold text-sm hover:bg-brand-600 transition-colors">
                        Update Data Kelas
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection