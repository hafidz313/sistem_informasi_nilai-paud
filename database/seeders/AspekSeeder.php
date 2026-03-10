<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aspek;

class AspekSeeder extends Seeder
{
    public function run()
    {
        $aspeks = [
            ['nama_aspek' => 'Nilai Agama dan Moral', 'kode' => 'NAM'],
            ['nama_aspek' => 'Fisik Motorik', 'kode' => 'FM'],
            ['nama_aspek' => 'Kognitif', 'kode' => 'KOG'],
            ['nama_aspek' => 'Bahasa', 'kode' => 'BHS'],
            ['nama_aspek' => 'Sosial Emosional', 'kode' => 'SE'],
            ['nama_aspek' => 'Seni', 'kode' => 'SEN'],
        ];

        foreach ($aspeks as $aspek) {
            Aspek::create($aspek);
        }
    }
}
