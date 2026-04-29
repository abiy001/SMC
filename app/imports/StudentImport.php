<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class StudentImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
{
    use SkipsFailures, SkipsErrors;

    public function model(array $row)
    {
        // Skip jika email sudah ada
        if (User::where('email', $row['email'])->exists()) {
            return null;
        }

        return DB::transaction(function () use ($row) {
            $user = User::create([
                'name'         => $row['nama'],
                'email'        => $row['email'],
                'number_phone' => $row['no_telepon'] ?? null,
                'role'         => 'student',
                'password'     => Hash::make('password123'),
            ]);

            Student::create([
                'user_id' => $user->id,
                'nisn'    => $row['nisn'] ?? null,
            ]);

            return $user; // return sesuatu agar tidak null
        });
    }

    public function rules(): array
    {
        return [
            'nama'  => 'required|string',
            'email' => 'required|email',
        ];
    }
}