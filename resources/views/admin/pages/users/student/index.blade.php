@extends('admin.layout-admin.app')

@section('content')
    <x-slot name="title">Data Student</x-slot>

    @include('admin.component.table.student-table')
@endsection