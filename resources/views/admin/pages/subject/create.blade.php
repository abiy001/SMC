@extends('admin.layout-admin.app')
@section('content')

<div class="p-6">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-2">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Mata Pelajaran</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Atur daftar mata pelajaran dan guru pengampu.</p>
        </div>
        <a href="{{ route('admin.subjects.create') }}"
            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Mapel
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl dark:bg-green-900/20 dark:border-green-800 dark:text-green-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Search --}}
    <div class="relative mb-6 max-w-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
        </svg>
        <input
            type="text"
            id="searchInput"
            placeholder="Cari nama mapel atau guru..."
            class="w-full pl-9 pr-4 py-2.5 text-sm rounded-xl border border-gray-200 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-500"
        />
    </div>

    {{-- Grid Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5" id="subjectGrid">

        @forelse($subjects as $subject)
        <div class="subject-card bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 flex flex-col gap-4 hover:shadow-md transition group relative">
            {{-- Icon --}}
            <div class="w-11 h-11 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>

            {{-- Name --}}
            <div>
                <h3 class="text-base font-semibold text-gray-800 dark:text-white subject-name">{{ $subject->name }}</h3>
            </div>

            {{-- Meta --}}
            <div class="flex flex-col gap-1.5 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-2 teacher-name">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>{{ $subject->teacher->name ?? 'Belum ada guru' }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $subject->schedule ?? 'Jadwal belum diatur' }}</span>
                </div>
            </div>

            {{-- Actions (shown on hover) --}}
            <div class="flex items-center gap-2 mt-auto pt-3 border-t border-gray-100 dark:border-gray-700 opacity-0 group-hover:opacity-100 transition">
                <a href="{{ route('admin.subjects.edit', $subject->id) }}"
                    class="flex-1 text-center text-xs font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 py-1.5 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition">
                    Edit
                </a>
                <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" class="flex-1"
                    onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full text-xs font-medium text-red-500 hover:text-red-600 py-1.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        @endforelse

        {{-- Add New Card --}}
        <a href="{{ route('admin.subjects.create') }}"
            class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700 p-6 flex flex-col items-center justify-center gap-2 text-gray-400 hover:border-indigo-400 hover:text-indigo-500 dark:hover:border-indigo-500 transition group min-h-[160px]">
            <div class="w-10 h-10 rounded-full border-2 border-dashed border-gray-300 group-hover:border-indigo-400 flex items-center justify-center transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <span class="text-sm font-medium">Tambah Mapel Baru</span>
        </a>
    </div>

    {{-- Empty State --}}
    @if($subjects->isEmpty())
    <div class="text-center py-16 text-gray-400 dark:text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 mx-auto mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        <p class="text-sm">Belum ada mata pelajaran. <a href="{{ route('admin.subjects.create') }}" class="text-indigo-500 hover:underline">Tambah sekarang</a></p>
    </div>
    @endif

    {{-- Pagination --}}
    @if($subjects->hasPages())
    <div class="mt-6">
        {{ $subjects->links() }}
    </div>
    @endif
</div>

{{-- Search Script --}}
<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.subject-card').forEach(card => {
            const name = card.querySelector('.subject-name')?.textContent.toLowerCase() ?? '';
            const teacher = card.querySelector('.teacher-name')?.textContent.toLowerCase() ?? '';
            card.style.display = (name.includes(query) || teacher.includes(query)) ? '' : 'none';
        });
    });
</script>

@endsection