@props(['data'])
<div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="border-b">
            <tr>
                <th class="p-2">Nama</th>
                <th class="p-2">Alat</th>
                <th class="p-2">Tgl Pinjam</th>
                <th class="p-2">Tgl Kembali</th>
                <th class="p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr class="border-b">
                <td class="p-2">{{ $d->nama_peminjam }}</td>
                <td class="p-2">{{ $d->alat->nama_alat ?? '-' }}</td>
                <td class="p-2">{{ $d->tgl_pinjam }}</td>
                <td class="p-2">{{ $d->tgl_kembali ?? '-' }}</td>
                <td class="p-2">{{ $d->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>