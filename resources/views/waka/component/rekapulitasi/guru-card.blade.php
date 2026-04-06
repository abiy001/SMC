<div class="bg-gradient-to-r from-slate-900 to-slate-800 text-white p-6 rounded-2xl">

    <div class="flex items-center gap-4">
        <img src="https://i.pravatar.cc/100" class="w-16 h-16 rounded-xl">

        <div>
            <span class="text-green-400 text-sm">● Status Aktif</span>
            <h2 class="text-2xl font-bold">{{ $guru->nama }}</h2>
            <p class="text-gray-300 text-sm">NIP: {{ $guru->nip }}</p>
        </div>
    </div>

    @include('waka.component.rekap.guru-stats')

</div>