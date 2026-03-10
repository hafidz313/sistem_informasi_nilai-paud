<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Biodata;
use Hash;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $siswas = [
            ['nama' => 'Ahmad Rizki', 'nisn' => 1001, 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '2018-05-10', 'jk' => 'l', 'kelas' => 'A'],
            ['nama' => 'Siti Nurhaliza', 'nisn' => 1002, 'tempat_lahir' => 'Bandung', 'tanggal_lahir' => '2018-03-15', 'jk' => 'p', 'kelas' => 'A'],
            ['nama' => 'Budi Santoso', 'nisn' => 1003, 'tempat_lahir' => 'Surabaya', 'tanggal_lahir' => '2018-07-20', 'jk' => 'l', 'kelas' => 'B'],
        ];

        foreach ($siswas as $data) {
            $siswa = User::create([
                'nama' => $data['nama'],
                'role' => 'siswa',
                'username' => 'siswa' . $data['nisn'],
                'password' => Hash::make('siswa'),
            ]);
            
            Biodata::create([
                'user_id' => $siswa->id,
                'nisn' => $data['nisn'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jk'],
                'agama' => 'Islam',
                'kelas' => $data['kelas'],
                'alamat' => 'Jl. Contoh',
            ]);
        }
    }
}
