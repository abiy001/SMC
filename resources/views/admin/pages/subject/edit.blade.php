@extends('admin.layout-admin.app')
@section('content')

<div class="p-6 max-w-2xl">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.subjects.index') }}"
            class="p-2 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Edit Mata Pelajaran</h1>
            <p class="text-xs text-gray-400 mt-0.5">Ubah data mata pelajaran</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6">
        <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Nama Pelajaran <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $subject->name) }}" placeholder="Contoh: Matematika"
                    class="h-11 w-full rounded-xl border bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-400
                    {{ $errors->has('name') ? 'border-red-400 dark:border-red-500' : 'border-gray-300 dark:border-gray-700' }}" />
                @error('name')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition">
                    Update
                </button>
                <a href="{{ route('admin.subjects.index') }}"
                    class="px-5 py-2.5 rounded-xl text-sm font-medium border border-gray-200 text-gray-600 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection