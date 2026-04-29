@extends('admin.layout-admin.app')

@section('content')
 
 
 <x-slot name="title">Data Teacher</x-slot>

    @include('admin.component.table.teacher-table')

@endsection