<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class WakaImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
{
    use SkipsFailures, SkipsErrors;

    public function model(array $row)
    {
        if (User::where('email', $row['email'])->exists()) {
            return null;
        }

        return new User([
            'name'         => $row['nama'],
            'email'        => $row['email'],
            'number_phone' => $row['no_telepon'] ?? null,
            'role'         => 'waka',
            'password'     => Hash::make(Str::random(12)),
        ]);
    }

    public function rules(): array
    {
        return [
            'nama'  => 'required|string',
            'email' => 'required|email',
        ];
    }
}