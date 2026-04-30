@extends('admin.layout-admin.app')

@section('content')
    {{-- Include komponen --}}
    @include('admin.component.schedule.schedule-modal')   {{-- ← modal HARUS duluan --}}

    <div class="space-y-5">
        {{-- Header & Filter --}}
        <div class="rounded-xl border border-gray-200 bg-white p-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3">
                    <label class="text-sm font-medium text-gray-700">Filter Guru:</label>
                    <select id="filter-teacher" class="h-10 rounded-lg border border-gray-300 bg-transparent px-3 text-sm">
                        <option value="">Semua Guru</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->user->name ?? '-' }}</option>
                        @endforeach
                    </select>
                </div>
                <button id="btn-add-schedule"
                    class="inline-flex items-center gap-2 rounded-lg bg-purple-600 px-4 py-2 text-sm font-medium text-white hover:bg-purple-700">
                    + Tambah Jadwal
                </button>
            </div>
        </div>

        {{-- Grid Jadwal --}}
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="p-5">
                @include('admin.component.schedule.schedule-calendar')  {{-- ← calendar belakangan --}}
            </div>
        </div>
    </div>
@endsection