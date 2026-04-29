@extends('admin.layout-admin.app')

@section('content')
  <div class="p-6 space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Pusat Aktivasi Lisensi</h1>
        <p class="text-gray-500">
            Kelola status langganan dan akses fitur premium aplikasi Monitoring KBM.
        </p>
    </div>

    <!-- Top Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @include('admin.component.lisensi.status-card')
        @include('admin.component.lisensi.fitur-card')
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @include('admin.component.lisensi.aktivasi-form')
        @include('admin.component.lisensi.support-card')
    </div>

</div>


@endsection