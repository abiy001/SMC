@extends('admin.layout-admin.app')

@section('content')
    <div class="space-y-4 md:space-y-6">
        <x-dashboard-admin.header />

        {{-- Main Grid: 2 columns on desktop --}}
        <div class="grid gap-4 xl:grid-cols-[1.6fr_1fr]">
            <div class="space-y-4">
                <x-dashboard-admin.card-total 
                    :totalUsers="$totalUsers"
                    :totalClasses="$totalClasses"
                    :totalSubjects="$totalSubjects"
                    :totalReports="$totalReports"
                />
                <x-ecommerce.monthly-sale />
            </div>

            <div class="space-y-4">
                <x-dashboard-admin.revenue />
            </div>
        </div>

        {{-- Shortcut Cards: 2 cols on sm, 4 cols on xl --}}
        <div class="grid gap-3 grid-cols-2 sm:grid-cols-2 xl:grid-cols-4">
            <x-dashboard-admin.shortcut-card />
        </div>
    </div>
@endsection