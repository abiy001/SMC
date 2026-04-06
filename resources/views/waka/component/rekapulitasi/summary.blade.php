@props(['total','aktif','selesai','terlambat'])
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    <div class="bg-white p-5 rounded-2xl shadow">
        <p>Total</p>
        <h2 class="text-2xl font-bold">{{ $total }}</h2>
    </div>

    <div class="bg-yellow-100 p-5 rounded-2xl shadow">
        <p>Aktif</p>
        <h2 class="text-2xl font-bold">{{ $aktif }}</h2>
    </div>

    <div class="bg-green-100 p-5 rounded-2xl shadow">
        <p>Selesai</p>
        <h2 class="text-2xl font-bold">{{ $selesai }}</h2>
    </div>

    <div class="bg-red-100 p-5 rounded-2xl shadow">
        <p>Terlambat</p>
        <h2 class="text-2xl font-bold">{{ $terlambat }}</h2>
    </div>

</div>