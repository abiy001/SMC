<x-common.component-card title="{{ isset($waka) ? 'Edit Waka' : 'Tambah Waka' }}">
    <form action="{{ isset($waka) ? route('admin.waka.update', $waka->id) : route('admin.waka.store') }}"
        method="POST" class="space-y-5">
        @csrf
        @if(isset($waka))
            @method('PUT')
        @endif

        {{-- Nama --}}
        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Nama <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name', $waka->name ?? '') }}"
                placeholder="Masukkan nama waka"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                @error('name') border-red-500 @enderror" />
            @error('name')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Email <span class="text-red-500">*</span>
            </label>
            <input type="email" name="email" value="{{ old('email', $waka->email ?? '') }}"
                placeholder="info@gmail.com"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                @error('email') border-red-500 @enderror" />
            @error('email')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- No. Telepon --}}
        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                No. Telepon
            </label>
            <input type="text" name="number_phone" value="{{ old('number_phone', $waka->number_phone ?? '') }}"
                placeholder="08xxxxxxxxxx"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
        </div>

        {{-- Tombol --}}
        <div class="flex items-center gap-3 mt-4">
            <button type="submit"
                class="bg-purple-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-purple-700">
                {{ isset($waka) ? 'Update' : 'Simpan' }}
            </button>
            <a href="{{ route('admin.waka.index') }}"
                class="px-5 py-2.5 rounded-lg text-sm font-medium border border-gray-300 text-gray-600 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.05]">
                Batal
            </a>
        </div>
    </form>
</x-common.component-card>