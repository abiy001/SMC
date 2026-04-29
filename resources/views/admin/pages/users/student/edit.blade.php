
@extends('admin.layout-admin.app')

@section('content')

<x-slot name="title">Edit Student</x-slot>

    @include('admin.component.form.student-form', ['student' => $student])
@endsection