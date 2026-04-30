@props([
    'data' => [
        ['label' => 'Hadir Penuh',    'value' => 2, 'color' => '#22C55E'],
        ['label' => 'Telat/Izin',     'value' => 1, 'color' => '#F59E0B'],
        ['label' => 'Hadir Sebentar', 'value' => 2, 'color' => '#F97316'],
        ['label' => 'Jam Kosong',     'value' => 1, 'color' => '#EF4444'],
    ]
])

@php
    $total = collect($data)->sum('value');
    $circumference = 2 * M_PI * 54; // radius = 54
    $gap = ($circumference / 360) * 4; // 4deg gap
    $offset = 0;
@endphp

<div class="bg-white rounded-2xl shadow-md p-5 w-72">

    {{-- Header --}}
    <div class="mb-4">
        <h3 class="text-sm font-bold text-gray-800">Komposisi Laporan</h3>
        <p class="text-xs text-gray-400 mt-1 leading-snug">Distribusi status kehadiran berdasarkan laporan.</p>
    </div>

    {{-- Donut Chart --}}
    <div class="flex justify-center items-center my-4 relative" style="height: 160px;">
        <svg width="160" height="160" viewBox="0 0 160 160" class="-rotate-90">
            {{-- Background ring --}}
            <circle cx="80" cy="80" r="54"
                fill="none"
                stroke="#F3F4F6"
                stroke-width="18"
            />

            @foreach($data as $item)
                @php
                    $percentage  = $total > 0 ? $item['value'] / $total : 0;
                    $arcLength   = ($percentage * $circumference) - $gap;
                    $dasharray   = $arcLength . ' ' . ($circumference - $arcLength);
                    $dashoffset  = -$offset;
                    $offset     += $percentage * $circumference;
                @endphp
                <circle
                    cx="80" cy="80" r="54"
                    fill="none"
                    stroke="{{ $item['color'] }}"
                    stroke-width="18"
                    stroke-linecap="round"
                    stroke-dasharray="{{ $dasharray }}"
                    stroke-dashoffset="{{ $dashoffset }}"
                    class="transition-all duration-700 ease-out"
                />
            @endforeach
        </svg>

        {{-- Center label --}}
        <div class="absolute flex flex-col items-center justify-center pointer-events-none">
            <span class="text-3xl font-extrabold text-gray-800 leading-none">{{ $total }}</span>
            <span class="text-[10px] font-semibold text-gray-400 tracking-wide mt-1">TOTAL DATA</span>
        </div>
    </div>

    {{-- Legend --}}
    <div class="flex flex-col gap-2.5 mt-2">
        @foreach($data as $item)
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color: {{ $item['color'] }}"></span>
                <span class="text-sm text-gray-600">{{ $item['label'] }}</span>
            </div>
            <span class="text-sm font-bold text-gray-800">{{ $item['value'] }}</span>
        </div>
        @endforeach
    </div>

</div>