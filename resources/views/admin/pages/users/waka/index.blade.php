@extends('admin.layout-admin.app')

@section('content')

    <x-common.page-breadcrumb title="User Management" />

    <div class="space-y-6">

       
    
        @include('admin.component.table.waka-table')

    </div>

@endsection