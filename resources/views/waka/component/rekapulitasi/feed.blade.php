@foreach($data as $d)
<div class="bg-white p-5 rounded-2xl shadow">

    <div class="flex justify-between">
        <h3 class="font-semibold">{{ $d->mapel }}</h3>
        <span class="text-sm text-gray-500">{{ $d->created_at }}</span>
    </div>

    <p class="text-sm text-gray-500">{{ $d->guru }}</p>

    <div class="mt-3 bg-gray-50 p-3 rounded-xl">
        <p><b>Agenda:</b> {{ $d->agenda }}</p>
        <p class="text-sm text-gray-600">{{ $d->jurnal }}</p>
    </div>

</div>
@endforeach