@php
    $user = auth()->user();
@endphp

<div class="flex items-center gap-3 p-3 rounded-2xl bg-gray-100 dark:bg-gray-800">

    <!-- Avatar -->
    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
    </div>

    <!-- Info -->
    <div class="flex-1">
        <p class="text-sm font-semibold text-gray-800 dark:text-white">
            {{ $user->name ?? 'User' }}
        </p>
        <p class="text-xs text-gray-500 dark:text-gray-400">
            {{ $user->email ?? '-' }}
        </p>
    </div>

</div>