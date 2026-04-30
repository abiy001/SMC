<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Imports\TeacherImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->paginate(10);
        return view('admin.pages.users.teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.pages.users.teacher.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'number_phone' => 'nullable|string|max:20',
            'nip'          => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {

        

            $user = User::create([
                'name'         => $validated['name'],
                'email'        => $validated['email'],
                'number_phone' => $validated['number_phone'] ?? null,
                'role'         => 'teacher',
               'password' => Hash::make('password123'),
            ]);

            Teacher::create([
                'user_id' => $user->id,
                'nip'     => $validated['nip'] ?? null,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan teacher: ' . $e->getMessage());
        }

        return redirect()->route('admin.teachers.index')
                         ->with('success', 'Teacher berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        return view('admin.pages.users.teacher.show', compact('teacher'));
    }

    public function edit(string $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        return view('admin.pages.users.teacher.edit', compact('teacher'));
    }

    public function update(Request $request, string $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => ['required', 'email', Rule::unique('users')->ignore($teacher->user_id)],
            'number_phone' => 'nullable|string|max:20',
            'nip'          => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            $teacher->user->update([
                'name'         => $validated['name'],
                'email'        => $validated['email'],
                'number_phone' => $validated['number_phone'] ?? null,
            ]);

            $teacher->update(['nip' => $validated['nip'] ?? null]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update teacher: ' . $e->getMessage());
        }

        return redirect()->route('admin.teachers.index')
                         ->with('success', 'Teacher berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);

        DB::beginTransaction();
        try {
            $teacher->user->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus teacher.');
        }

        return redirect()->route('admin.teachers.index')
                         ->with('success', 'Teacher berhasil dihapus!');
    }

    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls|max:2048',
    ]);

    Excel::import(new TeacherImport, $request->file('file'));

    return redirect()->route('admin.teachers.index')
                     ->with('success', 'Data teacher berhasil diimport!');
}
}