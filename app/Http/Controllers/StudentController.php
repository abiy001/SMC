<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->paginate(10);
        return view('admin.pages.users.student.index', compact('students'));
    }


    

    public function create()
    {
        return view('admin.pages.users.student.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'number_phone' => 'nullable|string|max:20',
            'nisn'         => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name'         => $validated['name'],
                'email'        => $validated['email'],
                'number_phone' => $validated['number_phone'] ?? null,
                'role'         => 'student',
                'password' => Hash::make('password123'), // password default saat import
            ]);

            Student::create([
                'user_id' => $user->id,
                'nisn'    => $validated['nisn'] ?? null,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan student: ' . $e->getMessage());
        }

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.pages.users.student.show', compact('student'));
    }

    public function edit(string $id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.pages.users.student.edit', compact('student'));
    }

    public function update(Request $request, string $id)
    {
        $student = Student::with('user')->findOrFail($id);

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => ['required', 'email', Rule::unique('users')->ignore($student->user_id)],
            'number_phone' => 'nullable|string|max:20',
            'nisn'         => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            $student->user->update([
                'name'         => $validated['name'],
                'email'        => $validated['email'],
                'number_phone' => $validated['number_phone'] ?? null,
            ]);

            $student->update(['nisn' => $validated['nisn'] ?? null]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update student: ' . $e->getMessage());
        }

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $student = Student::with('user')->findOrFail($id);

        DB::beginTransaction();
        try {
            $student->user->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus student.');
        }

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student berhasil dihapus!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        try {
            $import = new StudentImport();
            Excel::import($import, $request->file('file'));

            if ($import->failures()->isNotEmpty()) {
                $errors = collect($import->failures())->map(fn($f) =>
                    "Baris {$f->row()}: " . implode(', ', $f->errors())
                )->join('<br>');

                return back()->with('error', $errors);
            }

            return redirect()->route('admin.students.index')
                            ->with('success', 'Data student berhasil diimport!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }
}


