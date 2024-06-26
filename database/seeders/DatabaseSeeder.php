<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\Petugas::create([
            'nama_petugas' => "Administrator",
            'username' => "admin",
            'password' => Hash::make('password'),
            'telp' => '089603456754',
            'level' => 'admin',
        ]);
    }
}
