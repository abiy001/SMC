@extends('admin.layout-admin.app')

@section('content')
    <x-slot name="title">Edit Waka</x-slot>

    @include('admin.component.form.waka-form', ['waka' => $waka])
@endsection