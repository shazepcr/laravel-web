<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // <-- Pastikan baris ini ada

class CreateFirstUser extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'nazla25si@mahasiswa.pcr.ac.id',
            'password' => Hash::make('nazla250207')
        ]);
    }
}
