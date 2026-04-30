<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::paginate(10);
        return view('admin.pages.subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.pages.subject.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
        ]);

        Subject::create($validated);

        return redirect()->route('admin.subjects.index')
                         ->with('success', 'Pelajaran berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $subject = Subject::findOrFail($id);
        return view('admin.pages.subject.edit', compact('subject'));
    }

    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $id,
        ]);

        $subject->update($validated);

        return redirect()->route('admin.subjects.index')
                         ->with('success', 'Pelajaran berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('admin.subjects.index')
                         ->with('success', 'Pelajaran berhasil dihapus!');
    }
}