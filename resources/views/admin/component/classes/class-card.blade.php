{{-- resources/views/component/classes/class-card.blade.php --}}
@props(['class'])

<div class="relative group rounded-2xl overflow-hidden cursor-pointer"
     style="background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);">
    
    {{-- Level Badge --}}
    <div class="absolute top-3 left-3">
        <span class="text-[10px] font-semibold text-white/90 bg-white/20 backdrop-blur-sm px-2.5 py-1 rounded-full">
            Level {{ $class->grade ?? '-' }}
        </span>
    </div>

    {{-- Action Buttons (hover) --}}
    <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
        <a href="{{ route('admin.classes.edit', $class->id) }}"
           class="w-7 h-7 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center hover:bg-white/30 transition-colors">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
        <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus kelas {{ $class->name }}?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="w-7 h-7 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center hover:bg-red-500/60 transition-colors">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none">
                    <polyline points="3 6 5 6 21 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 11v6M14 11v6" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </form>
    </div>

    {{-- Content --}}
    <div class="px-4 pt-12 pb-3 flex flex-col items-center">
        {{-- Icon --}}
        <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mb-3">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                <path d="M3 9.5L12 4L21 9.5V19C21 19.5523 20.5523 20 20 20H4C3.44772 20 3 19.5523 3 19V9.5Z"
                    stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="rgba(255,255,255,0.2)"/>
                <path d="M9 20V14H15V20" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        {{-- Nama Kelas --}}
        <h3 class="text-2xl font-bold text-white mb-3">{{ $class->name }}</h3>
    </div>

    {{-- Footer --}}
    <div class="mx-3 mb-3 rounded-xl bg-black/20 backdrop-blur-sm px-4 py-2.5 flex items-center justify-center gap-2">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="white" stroke-width="2" stroke-linecap="round"/>
            <circle cx="9" cy="7" r="4" stroke="white" stroke-width="2"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="white" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span class="text-sm font-semibold text-white">{{ $class->capacity }} Siswa</span>
    </div>
</div>