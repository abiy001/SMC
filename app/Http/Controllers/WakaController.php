<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Imports\WakaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class WakaController extends Controller
{
    // GET /admin/waka
    public function index()
    {
        $wakas = User::where('role', 'waka')->paginate(10);
        return view('admin.pages.users.waka.index', compact('wakas'));
    }


    public function show(string $id)
{
    $waka = User::where('role', 'waka')->findOrFail($id);
    return view('admin.pages.users.waka.show', compact('waka'));
}

    // GET /admin/waka/create
    public function create()
    {
        return view('admin.pages.users.waka.create');
    }

    // POST /admin/waka
    public function store(Request $request)
    {
      $validated = $request->validate([
        'name'         => 'required|string|max:255',
        'email'        => 'required|email|unique:users,email',
        'number_phone' => 'nullable|string|max:20',
        'password'     => 'nullable|string|min:6',  // ← aturan validasi, bukan Hash
      ]);

      User::create([
        'name'         => $validated['name'],
        'email'        => $validated['email'],
        'number_phone' => $validated['number_phone'] ?? null,
        'role'         => 'waka',
        'password'     => Hash::make($validated['password'] ?? 'password123'), // ← Hash di sini
      ]);

      return redirect()->route('admin.waka.index')
                     ->with('success', 'Waka berhasil ditambahkan!');
    }
    // GET /admin/waka/{id}/edit
    public function edit(string $id)
    {
        $waka = User::where('role', 'waka')->findOrFail($id);
        return view('admin.pages.users.waka.edit', compact('waka'));
    }

    // PUT /admin/waka/{id}
    public function update(Request $request, string $id)
    {
        $waka = User::where('role', 'waka')->findOrFail($id);

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => ['required', 'email', Rule::unique('users')->ignore($waka->id)],
            'number_phone' => 'nullable|string|max:20',
        ]);

        $waka->update($validated);

        return redirect()->route('admin.waka.index')
                         ->with('success', 'Waka berhasil diupdate!');
    }

    // DELETE /admin/waka/{id}
    public function destroy(string $id)
    {
        $waka = User::where('role', 'waka')->findOrFail($id);
        $waka->delete();

        return redirect()->route('admin.waka.index')
                         ->with('success', 'Waka berhasil dihapus!');
    }
  
    public function import(Request $request)
    {
      $request->validate(['file' => 'required|mimes:xlsx,xls']);

      try {
        $import = new WakaImport();
        Excel::import($import, $request->file('file'));

        // Cek validation failures
        if ($import->failures()->isNotEmpty()) {
            $errors = collect($import->failures())->map(fn($f) =>
                "Baris {$f->row()}: " . implode(', ', $f->errors())
            )->join('<br>');

            return back()->with('error', $errors);
        }

       return back()->with('success', 'Data waka berhasil diimport.');
      } catch (\Exception $e) {
       return back()->with('error', 'Gagal import: ' . $e->getMessage());
    `}
  }
}
