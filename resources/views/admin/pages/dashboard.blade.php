@extends('admin.layout-admin.app')

@section('content')
    <div class="space-y-6">
        <x-dashboard-admin.header />

        <div class="grid gap-4 xl:grid-cols-[1.6fr_1fr]">
            <div class="space-y-4">
                <x-dashboard-admin.card-total />
                <x-ecommerce.monthly-sale />
            </div>

            <div class="space-y-4">
                <x-dashboard-admin.revenue />
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <x-dashboard-admin.shortcut-card />
        </div>
    </div>
@endsection
