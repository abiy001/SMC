   
<div class="flex items-center gap-2">
        <a href="{{ route('admin.teachers.create') }}"
            class="inline-flex items-center gap-2 rounded-lg bg-purple-600 px-4 py-2 text-sm font-medium text-white hover:bg-purple-700">
            + Tambah Teacher
        </a>

         <button onclick="document.getElementById('import-modal').classList.remove('hidden')"
            class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700">
            Import Excel
        </button>

         <a href="{{ route('admin.teachers.template') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400">
            Download Template
        </a>
    </div>

     <div id="import-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="w-full max-w-md rounded-xl bg-white p-6 dark:bg-gray-900">
            <h3 class="mb-4 text-base font-medium text-gray-800 dark:text-white/90">Import Data Teacher</h3>

            <form action="{{ route('admin.teachers.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Pilih File Excel (.xlsx)
                    </label>
                    <input type="file" name="file" accept=".xlsx,.xls"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    @error('file')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <p class="text-xs text-gray-400">
                    Pastikan file sesuai template. Kolom yang dibutuhkan:
                    <strong>nama, email, no_telepon</strong>
                </p>

                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="rounded-lg bg-green-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-700">
                        Import
                    </button>
                    <button type="button"
                        onclick="document.getElementById('import-modal').classList.add('hidden')"
                        class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

