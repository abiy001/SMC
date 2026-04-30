{{-- ── Grid Jadwal ──────────────────────────────────────────── --}}
<div class="overflow-x-auto">
    <table class="w-full border-collapse text-sm">
        <thead>
            <tr>
                {{-- Kolom Jam --}}
                <th class="w-24 border-b border-r border-gray-100 bg-gray-50/80 px-3 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-400 dark:border-gray-700 dark:bg-gray-800">
                    JAM KE
                </th>

                @php
                    $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                    $hariIndex = ['Senin'=>1,'Selasa'=>2,'Rabu'=>3,'Kamis'=>4,'Jumat'=>5,'Sabtu'=>6];
                    $todayIndex = date('N'); // 1=Mon ... 6=Sat, 7=Sun
                @endphp

                @foreach($hariList as $day)
                    @php $isToday = $hariIndex[$day] == $todayIndex; @endphp
                    <th class="border-b border-r border-gray-100 bg-gray-50/80 px-3 py-4 text-center text-sm font-semibold dark:border-gray-700 dark:bg-gray-800
                        {{ $isToday ? 'text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-300' }}">
                        <span class="relative inline-block pb-1.5">
                            {{ $day }}
                            @if($isToday)
                                <span class="absolute bottom-0 left-0 right-0 h-0.5 rounded-full bg-blue-500"></span>
                            @endif
                        </span>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody id="schedule-body">
            {{-- Diisi via JS --}}
        </tbody>
    </table>
</div>

<script>
const JAM = [
    {ke:1,  waktu:'7:00'},  {ke:2,  waktu:'7:45'},  {ke:3,  waktu:'8:30'},
    {ke:4,  waktu:'9:15'},  {ke:5,  waktu:'10:00'}, {ke:6,  waktu:'10:45'},
    {ke:7,  waktu:'11:30'}, {ke:8,  waktu:'12:15'}, {ke:9,  waktu:'13:00'},
    {ke:10, waktu:'13:45'}, {ke:11, waktu:'14:30'}, {ke:12, waktu:'15:15'},
];
const DAYS = ['senin','selasa','rabu','kamis','jumat','sabtu'];

// Deteksi hari ini (0=Sun,1=Mon,...6=Sat) → index DAYS (0=senin..5=sabtu)
const todayDayIndex = new Date().getDay(); // 0..6
const todayDaysIdx  = todayDayIndex === 0 ? -1 : todayDayIndex - 1; // -1 = Minggu (tidak ada)

const COLOR_MAP = {
    Primary: 'from-violet-500 to-purple-600',
    Success: 'from-green-400  to-emerald-500',
    Warning: 'from-yellow-400 to-amber-500',
    Danger:  'from-red-400    to-rose-500',
};

let scheduleData = [];

// ── Render Grid ────────────────────────────────────────────
function renderGrid() {
    const tbody = document.getElementById('schedule-body');
    tbody.innerHTML = '';

    JAM.forEach(jam => {
        const tr = document.createElement('tr');
        tr.className = 'group';

        // ── Kolom Jam
        tr.innerHTML = `
            <td class="border-b border-r border-gray-100 px-3 py-3 text-center align-middle dark:border-gray-700">
                <div class="flex h-9 w-9 mx-auto items-center justify-center rounded-full bg-gray-100 text-xs font-bold text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                    ${jam.ke}
                </div>
                <div class="mt-1 text-[11px] font-medium text-gray-400">${jam.waktu}</div>
            </td>`;

        DAYS.forEach((day, dayIdx) => {
            const isToday = dayIdx === todayDaysIdx;

            const event = scheduleData.find(e =>
                e.extendedProps.day === day &&
                parseInt(e.extendedProps.lesson_hour) === jam.ke
            );

            const td = document.createElement('td');
            td.className = `border-b border-r border-gray-100 p-2 align-top dark:border-gray-700 transition-colors
                ${isToday ? 'bg-blue-50/30 dark:bg-blue-900/10' : ''}`;
            td.style.minWidth = '140px';

            if (event) {
                const grad  = COLOR_MAP[event.extendedProps.color] ?? COLOR_MAP.Primary;
                const room  = event.extendedProps.room ?? '';
                const kelas = event.extendedProps.class ?? '';

                td.innerHTML = `
                    <div class="cursor-pointer rounded-2xl bg-gradient-to-br ${grad} p-3 text-white shadow-md hover:shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all duration-150"
                         data-id="${event.id}">

                        {{-- Badge kelas --}}
                        <div class="mb-1.5 inline-flex items-center gap-1 rounded-full bg-white/20 px-2 py-0.5 backdrop-blur-sm">
                            <svg class="h-3 w-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-[10px] font-semibold leading-none">${kelas}</span>
                        </div>

                        {{-- Nama Jadwal --}}
                        <div class="text-[15px] font-extrabold leading-snug tracking-tight">${event.title}</div>

                        {{-- Ruangan --}}
                        ${room ? `
                        <div class="mt-2 flex items-center gap-1 opacity-85">
                            <svg class="h-3 w-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-[11px] font-medium">${room}</span>
                        </div>` : ''}
                    </div>`;

                td.querySelector('[data-id]').addEventListener('click', () => openEditModal(event));

            } else {
                td.innerHTML = `
                    <button class="flex h-full w-full min-h-[88px] items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 text-gray-300
                                   hover:border-purple-400 hover:bg-purple-50 hover:text-purple-400
                                   dark:border-gray-700 dark:hover:border-purple-600 dark:hover:bg-purple-900/20 dark:hover:text-purple-400
                                   transition-all duration-150 group/btn"
                            data-day="${day}" data-hour="${jam.ke}">
                        <svg class="h-5 w-5 transition-transform duration-150 group-hover/btn:scale-110"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </button>`;

                td.querySelector('button').addEventListener('click', e => {
                    openAddModal(e.currentTarget.dataset.day, e.currentTarget.dataset.hour);
                });
            }

            tr.appendChild(td);
        });

        tbody.appendChild(tr);
    });
}

// ── Fetch Events ───────────────────────────────────────────
function fetchSchedule(teacherId = '') {
    const url = '{{ route("admin.schedule.events") }}' + (teacherId ? `?teacher_id=${teacherId}` : '');
    fetch(url)
        .then(r => r.json())
        .then(data => {
            scheduleData = data;
            renderGrid();
        })
        .catch(() => renderGrid());
}

// ── Modal Helpers ──────────────────────────────────────────
const modal = document.getElementById('scheduleModal');

function showModal() {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function hideModal() {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.getElementById('modal-error').classList.add('hidden');
    document.getElementById('input-id').value = '';
    document.getElementById('btn-delete').style.display = 'none';
    document.getElementById('modal-title').textContent = 'Tambah Jadwal';
}

function openAddModal(day, hour) {
    hideModal();
    document.getElementById('input-day').value    = day;
    document.getElementById('input-hour').value   = hour;
    document.getElementById('input-title').value  = '';
    document.getElementById('input-teacher').value = '';
    document.getElementById('input-subject').value = '';
    document.getElementById('input-class').value   = '';
    document.getElementById('input-room').value    = '';
    document.querySelector('.color-radio[value="Primary"]').checked = true;
    document.getElementById('modal-title').textContent = 'Tambah Jadwal';
    showModal();
}

function openEditModal(event) {
    hideModal();
    const p = event.extendedProps;
    document.getElementById('input-id').value      = event.id;
    document.getElementById('input-title').value   = event.title;
    document.getElementById('input-day').value     = p.day;
    document.getElementById('input-hour').value    = p.lesson_hour;
    document.getElementById('input-room').value    = p.room ?? '';
    document.getElementById('modal-title').textContent = 'Edit Jadwal';
    document.getElementById('btn-delete').style.display = 'inline-flex';
    const radio = document.querySelector(`.color-radio[value="${p.color}"]`);
    if (radio) radio.checked = true;
    showModal();
}

// ── Simpan ─────────────────────────────────────────────────
document.getElementById('btn-save').addEventListener('click', () => {
    const id      = document.getElementById('input-id').value;
    const payload = {
        title:       document.getElementById('input-title').value,
        teacher_id:  document.getElementById('input-teacher').value,
        subject_id:  document.getElementById('input-subject').value,
        class_id:    document.getElementById('input-class').value,
        day:         document.getElementById('input-day').value,
        lesson_hour: document.getElementById('input-hour').value,
        room:        document.getElementById('input-room').value,
        color:       document.querySelector('.color-radio:checked')?.value ?? 'Primary',
        _token:      '{{ csrf_token() }}',
    };

    const isEdit = id !== '';
    const url    = isEdit ? `/admin/schedule/${id}` : '{{ route("admin.schedule.store") }}';
    const method = isEdit ? 'PUT' : 'POST';

    fetch(url, {
        method,
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify(payload),
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            hideModal();
            fetchSchedule(document.getElementById('filter-teacher')?.value ?? '');
        } else {
            const errDiv = document.getElementById('modal-error');
            errDiv.textContent = res.message ?? 'Terjadi kesalahan.';
            errDiv.classList.remove('hidden');
        }
    })
    .catch(() => {
        const errDiv = document.getElementById('modal-error');
        errDiv.textContent = 'Gagal menyimpan jadwal.';
        errDiv.classList.remove('hidden');
    });
});

// ── Hapus ──────────────────────────────────────────────────
document.getElementById('btn-delete').addEventListener('click', () => {
    const id = document.getElementById('input-id').value;
    if (!id || !confirm('Hapus jadwal ini?')) return;
    fetch(`/admin/schedule/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) { hideModal(); fetchSchedule(); }
    });
});

// ── Tutup Modal ────────────────────────────────────────────
document.getElementById('btn-close-modal').addEventListener('click', hideModal);
document.getElementById('btn-cancel').addEventListener('click', hideModal);
document.getElementById('modal-backdrop').addEventListener('click', hideModal);

// ── Filter Guru ────────────────────────────────────────────
document.getElementById('filter-teacher')?.addEventListener('change', e => {
    fetchSchedule(e.target.value);
});

// ── Tombol Tambah di Header ────────────────────────────────
document.getElementById('btn-add-schedule').addEventListener('click', () => {
    openAddModal('', '');
});

// ── Init ───────────────────────────────────────────────────
fetchSchedule();
</script>