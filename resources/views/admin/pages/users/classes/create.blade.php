@extends('admin.layout-admin.app')
@section('content')
    <div class="max-w-lg mx-auto">
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 space-y-5">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Tambah Kelas Baru</h2>
            <form action="{{ route('admin.classes.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama Kelas</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: X-5"
                        class="w-full h-11 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent px-4 text-sm @error('name') border-red-400 @enderror" />
                    @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Jenjang</label>
                    <select name="level" class="w-full h-11 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent px-4 text-sm">
                        <option value="SD">SD</option><option value="SMP">SMP</option><option value="SMA" selected>SMA</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tingkat</label>
                    <input type="text" name="grade" value="{{ old('grade') }}" placeholder="Contoh: X"
                        class="w-full h-11 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent px-4 text-sm" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Kapasitas Siswa</label>
                    <input type="number" name="capacity" value="{{ old('capacity', 36) }}"
                        class="w-full h-11 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent px-4 text-sm" />
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 py-2.5 rounded-xl bg-brand-500 text-white font-semibold text-sm hover:bg-brand-600">Simpan</button>
                    <a href="{{ route('admin.classes.index') }}" class="flex-1 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-medium text-center hover:bg-gray-50">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection