<div class="bg-white p-6 rounded-2xl shadow">

    <div class="flex justify-between mb-4">
        <h3 class="font-semibold text-lg">Riwayat Aktivitas KBM</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">

            <thead class="border-b text-gray-500">
                <tr>
                    <th class="p-2 text-left">Tanggal</th>
                    <th class="p-2 text-left">Mapel</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Agenda</th>
                    <th class="p-2 text-left">Pelapor</th>
                </tr>
            </thead>

            <tbody>
                @foreach($aktivitas as $a)
                <tr class="border-b">
                    <td class="p-2">{{ $a->tgl }}</td>
                    <td class="p-2">{{ $a->mapel }}</td>
                    <td class="p-2">
                        <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">
                            {{ $a->status }}
                        </span>
                    </td>
                    <td class="p-2">{{ $a->agenda }}</td>
                    <td class="p-2">{{ $a->pelapor }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>