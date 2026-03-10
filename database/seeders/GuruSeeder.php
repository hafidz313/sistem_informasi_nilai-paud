<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Biodata;
use Hash;

class GuruSeeder extends Seeder
{
    public function run()
    {
        $guru = User::create([
            'nama' => 'Guru PAUD',
            'role' => 'guru',
            'username' => 'guru',
            'password' => Hash::make('guru'),
        ]);
        
        Biodata::create([
            'user_id' => $guru->id,
            'nip' => 1234567890,
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'p',
            'agama' => 'Islam',
            'alamat' => 'Jl. Contoh No. 1',
        ]);
    }
}
