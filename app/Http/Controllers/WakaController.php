<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Waka;
use Illuminate\Http\Request;

class WakaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $guru = $request->guru;

    if ($guru) {
        // MODE DETAIL
        return view('waka.pages.rekap', [
            'mode' => 'detail',
            'guru' => $guru,
            'data' => [], // isi sesuai kebutuhan
            'aktivitas' => [],
            'total' => 3,
            'disiplin' => 83,
            'kelas' => 1,
        ]);
    }

    // MODE FEED (default)
    return view('waka.pages.rekap', [
        'mode' => 'feed',
        'data' => [] // isi data feed
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Waka $waka)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Waka $waka)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Waka $waka)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Waka $waka)
    {
        //
    }
}
