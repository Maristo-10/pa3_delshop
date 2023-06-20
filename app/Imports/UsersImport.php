<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $isExistingUser = User::where('email', $row['email'])->first();
        if ($isExistingUser) {
            // Store an error message in the session
            Session::flash('error', 'Data Sudah Terdaftar!');
            return null; // Return null for the existing user, so it won't be saved
        }        return new User([
            'name' => $row['nama'],
            'email' => $row['email'],
            'role_pengguna' => $row['role_pengguna']
            // 'name' => $row[0],
            // 'email' => $row[1],
            // 'role_pengguna' => $row[2]
        ]);
    }
}
