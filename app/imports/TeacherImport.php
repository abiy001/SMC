<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class TeacherImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
{
    use SkipsFailures, SkipsErrors;

    public function model(array $row)
    {
        if (User::where('email', $row['email'])->exists()) {
            return null;
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name'         => $row['nama'],
                'email'        => $row['email'],
                'number_phone' => $row['no_telepon'] ?? null,
                'role'         => 'teacher',
                'password'     => Hash::make('password123'),
            ]);

            Teacher::create([
                'user_id' => $user->id,
                'nip'     => $row['nip'] ?? null,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }

        return null; // return null karena sudah manual create
    }

    public function rules(): array
    {
        return [
            'nama'  => 'required|string',
            'email' => 'required|email',
        ];
    }
}