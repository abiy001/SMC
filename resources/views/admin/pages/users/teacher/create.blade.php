@extends('admin.layout-admin.app')

@section('content')
<x-slot name="title">Tambah Teacher</x-slot>

    @include('admin.component.form.teacher-form')
@endsection