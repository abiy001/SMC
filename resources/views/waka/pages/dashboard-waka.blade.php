@extends('waka.layouts.app')

@section('content')
<div class=" grid grid-cols-12 gap-6">

    <!-- CARD -->
    <div class="col-span-12">
        @include('waka.component.component-card')
    </div>

    <!-- STATS & TARGET -->
    <div class="col-span-12 grid grid-cols-12 gap-6 w-full">
        
          <div class="col-span-8 w-full overflow-hidden">
            @include('waka.component.component-stats')
        </div>

         <div class="col-span-4">
            @include('waka.component.component-target')
        </div>

    </div>

    <!-- TABLE -->
    <div class="col-span-12">
        <h3 class="text-2xl font-semibold mb-4">
            Data Jurnal Kelas
        </h3>

        @include('waka.component.component-tables')
    </div>

</div>
@endsection