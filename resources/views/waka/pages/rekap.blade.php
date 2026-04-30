@extends('waka.layouts.app')

@section('content')
<div class="space-y-6">

    @include('waka.component.rekapulitasi.header')

    @include('waka.component.rekapulitasi.filter-info')

    @if($mode == 'feed')
        @include('waka.component.rekapulitasi.feed')
    @else
        @include('waka.component.rekap.guru-card')
        @include('waka.component.rekap.guru-table')
    @endif

</div>
@endsection