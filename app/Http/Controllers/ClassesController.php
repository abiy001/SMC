<?php
// app/Http/Controllers/ClassesController.php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = Classes::orderBy('level')->orderBy('grade')->orderBy('name')->get();
        
        // Group by level
        $grouped = $classes->groupBy('level');
        
        return view('admin.pages.users.classes.index', compact('classes', 'grouped'));
    }

    public function create()
    {
        return view('admin.pages.users.classes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255|unique:classes,name',
            'level'    => 'required|in:SD,SMP,SMA',
            'grade'    => 'nullable|string|max:20',
            'capacity' => 'required|integer|min:1|max:100',
        ]);

        Classes::create($validated);

        return redirect()->route('admin.classes.index')
                         ->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $class = Classes::findOrFail($id);
        return view('admin.pages.users.classes.edit', compact('class'));
    }

    public function update(Request $request, string $id)
    {
        $class = Classes::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255|unique:classes,name,' . $id,
            'level'    => 'required|in:SD,SMP,SMA',
            'grade'    => 'nullable|string|max:20',
            'capacity' => 'required|integer|min:1|max:100',
        ]);

        $class->update($validated);

        return redirect()->route('admin.classes.index')
                         ->with('success', 'Kelas berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();

        return redirect()->route('admin.classes.index')
                         ->with('success', 'Kelas berhasil dihapus!');
    }
}