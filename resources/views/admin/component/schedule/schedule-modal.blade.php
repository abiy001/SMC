{{-- ── Modal Jadwal ─────────────────────────────────────────── --}}
<div class="fixed inset-0 hidden items-center justify-center p-4 overflow-y-auto z-[99999]" id="scheduleModal">

    {{-- Backdrop --}}
    <div id="modal-backdrop"
         class="fixed inset-0 h-full w-full bg-gray-900/40 backdrop-blur-sm"></div>

    {{-- Panel --}}
    <div class="relative z-10 flex w-full max-w-[600px] flex-col rounded-3xl bg-white p-6 shadow-2xl lg:p-8 dark:bg-gray-900">

        {{-- Tombol Tutup --}}
        <button id="btn-close-modal"
            class="absolute right-5 top-5 flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 transition dark:bg-gray-800 dark:hover:bg-gray-700">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M6.043 16.542a1 1 0 001.414 1.414L12 13.414l4.543 4.542a1 1 0 001.414-1.414L13.414 12l4.543-4.543a1 1 0 00-1.414-1.414L12 10.586 7.457 6.043A1 1 0 006.043 7.457L10.586 12l-4.543 4.542z"
                    fill="currentColor"/>
            </svg>
        </button>

        {{-- Judul Modal --}}
        <div class="mb-6">
            <div class="mb-1 flex items-center gap-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-purple-600 dark:bg-purple-900/30">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h5 id="modal-title" class="text-lg font-bold text-gray-800 dark:text-white">Tambah Jadwal</h5>
            </div>
            <p class="pl-10 text-sm text-gray-400 dark:text-gray-500">Atur jadwal mengajar guru</p>
        </div>

        <input type="hidden" id="input-id" />

        <div class="space-y-4">

            {{-- Judul Jadwal --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Judul Jadwal <span class="text-red-500">*</span>
                </label>
                <input id="input-title" type="text" placeholder="Contoh: Matematika"
                    class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 outline-none
                           focus:border-purple-500 focus:bg-white focus:ring-2 focus:ring-purple-100
                           dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:bg-gray-800" />
            </div>

            {{-- Guru --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Guru <span class="text-red-500">*</span>
                </label>
                <select id="input-teacher"
                    class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none
                           focus:border-purple-500 focus:bg-white focus:ring-2 focus:ring-purple-100
                           dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                    <option value="">Pilih Guru</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->user->name ?? '-' }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Pelajaran & Kelas --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Pelajaran</label>
                    <select id="input-subject"
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none
                               focus:border-purple-500 focus:bg-white focus:ring-2 focus:ring-purple-100
                               dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <option value="">Pilih Pelajaran</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Kelas</label>
                    <select id="input-class"
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none
                               focus:border-purple-500 focus:bg-white focus:ring-2 focus:ring-purple-100
                               dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <option value="">Pilih Kelas</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Hari & Jam Ke --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Hari <span class="text-red-500">*</span>
                    </label>
                    <select id="input-day"
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none
                               focus:border-purple-500 focus:bg-white focus:ring-2 focus:ring-purple-100
                               dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <option value="">Pilih Hari</option>
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Jam Ke <span class="text-red-500">*</span>
                    </label>
                    <select id="input-hour"
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none
                               focus:border-purple-500 focus:bg-white focus:ring-2 focus:ring-purple-100
                               dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <option value="">Pilih Jam</option>
                        @foreach(range(1, 12) as $h)
                            <option value="{{ $h }}">Jam ke-{{ $h }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Ruangan --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Ruangan</label>
                <input id="input-room" type="text" placeholder="Contoh: R. 101"
                    class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 outline-none
                           focus:border-purple-500 focus:bg-white focus:ring-2 focus:ring-purple-100
                           dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
            </div>

            {{-- Warna --}}
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Warna Label</label>
                <div class="flex flex-wrap gap-3">
                    @foreach([
                        'Primary' => ['label'=>'Ungu',   'hex'=>'#7C3AED', 'ring'=>'ring-violet-400'],
                        'Success' => ['label'=>'Hijau',   'hex'=>'#22C55E', 'ring'=>'ring-green-400'],
                        'Warning' => ['label'=>'Kuning',  'hex'=>'#F59E0B', 'ring'=>'ring-amber-400'],
                        'Danger'  => ['label'=>'Merah',   'hex'=>'#EF4444', 'ring'=>'ring-red-400'],
                    ] as $val => $item)
                        <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-gray-200 px-3 py-2 text-sm text-gray-700
                                      hover:border-gray-300 hover:bg-gray-50 transition dark:border-gray-700 dark:text-gray-300">
                            <input type="radio" name="event-color" value="{{ $val }}" class="color-radio sr-only"
                                {{ $val === 'Primary' ? 'checked' : '' }} />
                            <span class="flex h-4 w-4 items-center justify-center rounded-full ring-2 ring-offset-1 {{ $item['ring'] }}"
                                  style="background:{{ $item['hex'] }}">
                            </span>
                            {{ $item['label'] }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Error --}}
            <div id="modal-error"
                 class="hidden rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-900 dark:bg-red-900/20 dark:text-red-400">
            </div>

            {{-- Buttons --}}
            <div class="flex flex-wrap items-center gap-3 border-t border-gray-100 pt-4 dark:border-gray-700">
                <button id="btn-save"
                    class="rounded-xl bg-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-700 active:scale-95 transition">
                    Simpan Jadwal
                </button>
                <button id="btn-delete" style="display:none"
                    class="inline-flex items-center gap-1.5 rounded-xl bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-100 active:scale-95 transition dark:bg-red-900/20 dark:text-red-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
                <button id="btn-cancel"
                    class="rounded-xl border border-gray-200 px-5 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 active:scale-95 transition dark:border-gray-700 dark:text-gray-400">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>