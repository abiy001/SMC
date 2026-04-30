@extends('admin.layout-admin.app')

@section('content')
<x-slot name="title">Edit Teacher</x-slot>

    @include('admin.component.form.teacher-form', ['teacher' => $teacher])
@endsection