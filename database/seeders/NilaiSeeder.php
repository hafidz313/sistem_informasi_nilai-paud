<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;

class NilaiSeeder extends Seeder
{
    public function run()
    {
        $nilais = [
            ['user_id' => 3, 'poin_id' => 1, 'semester' => 1, 'awal_ajaran' => 2023, 'akhir_ajaran' => 2024, 'nilai' => 'bsh'],
            ['user_id' => 3, 'poin_id' => 2, 'semester' => 1, 'awal_ajaran' => 2023, 'akhir_ajaran' => 2024, 'nilai' => 'bsb'],
            ['user_id' => 3, 'poin_id' => 4, 'semester' => 1, 'awal_ajaran' => 2023, 'akhir_ajaran' => 2024, 'nilai' => 'mb'],
            
            ['user_id' => 4, 'poin_id' => 1, 'semester' => 1, 'awal_ajaran' => 2023, 'akhir_ajaran' => 2024, 'nilai' => 'bsb'],
            ['user_id' => 4, 'poin_id' => 2, 'semester' => 1, 'awal_ajaran' => 2023, 'akhir_ajaran' => 2024, 'nilai' => 'bsh'],
        ];

        foreach ($nilais as $nilai) {
            Nilai::create($nilai);
        }
    }
}
