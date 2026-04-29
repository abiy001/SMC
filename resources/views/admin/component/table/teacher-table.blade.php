<div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

    <div class ="p-5">
        @include('admin.component.button.teacher-button')
    </div>

    @if(session('success'))
        <div class="mx-5 mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700 dark:bg-green-500/15 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mx-5 mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700 dark:bg-red-500/15 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <div class="max-w-full overflow-x-auto custom-scrollbar">
        <table class="w-full min-w-[800px]">
            <thead>
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <th class="px-5 py-3 text-left sm:px-6">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">No</p>
                    </th>
                    <th class="px-5 py-3 text-left sm:px-6">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nama</p>
                    </th>
                    <th class="px-5 py-3 text-left sm:px-6">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Email</p>
                    </th>
                    <th class="px-5 py-3 text-left sm:px-6">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">NIP</p>
                    </th>
                    <th class="px-5 py-3 text-left sm:px-6">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">No. Telepon</p>
                    </th>
                    <th class="px-5 py-3 text-left sm:px-6">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $index => $teacher)
                    <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                        <td class="px-5 py-4 sm:px-6">
                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                {{ $teachers->firstItem() + $index }}
                            </p>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                {{ $teacher->user->name ?? '-' }}
                            </p>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                {{ $teacher->user->email ?? '-' }}
                            </p>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                {{ $teacher->nip ?? '-' }}
                            </p>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                {{ $teacher->user->number_phone ?? '-' }}
                            </p>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                                    class="inline-flex items-center rounded-lg bg-yellow-50 px-3 py-1.5 text-xs font-medium text-yellow-700 hover:bg-yellow-100 dark:bg-yellow-500/15 dark:text-yellow-400">
                                    Edit
                                </a>
                                <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus teacher ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center rounded-lg bg-red-50 px-3 py-1.5 text-xs font-medium text-red-700 hover:bg-red-100 dark:bg-red-500/15 dark:text-red-400">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-gray-400 text-theme-sm dark:text-gray-500">
                            Belum ada data teacher.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($teachers->hasPages())
        <div class="px-5 py-4 sm:px-6">
            {{ $teachers->links() }}
        </div>
    @endif
</div>