@extends('admin.layout-admin.app')

@section('content')  
  <x-slot name="title">Tambah Student</x-slot>

    @include('admin.component.form.student-form')
@endsection