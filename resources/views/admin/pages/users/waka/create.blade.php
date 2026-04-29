@extends('admin.layout-admin.app')

@section('content')

<x-common.page-breadcrumb title="User Management" />

<div class="space-y-6">

    <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-2">Import file</h2>

        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="file" name="file" class="border p-2 mb-2 w-full">

            <button class="bg-purple-600 text-white px-4 py-2 rounded">
                Import CSV
            </button>
        </form>
    </div>

    <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-2">Tambah Manual</h2>

        @include('admin.component.form.waka-form')
    </div>

</div>

@endsection