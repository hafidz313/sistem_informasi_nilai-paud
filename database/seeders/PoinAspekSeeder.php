<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PoinAspek;

class PoinAspekSeeder extends Seeder
{
    public function run()
    {
        $poins = [
            ['nama_poin' => 'Berdoa sebelum dan sesudah melakukan kegiatan', 'aspek_id' => 1],
            ['nama_poin' => 'Mengenal perilaku baik/sopan dan buruk', 'aspek_id' => 1],
            ['nama_poin' => 'Memiliki perilaku yang mencerminkan sikap jujur', 'aspek_id' => 1],
            
            ['nama_poin' => 'Melakukan gerakan terkoordinasi secara terkontrol', 'aspek_id' => 2],
            ['nama_poin' => 'Melakukan kegiatan kebersihan diri', 'aspek_id' => 2],
            ['nama_poin' => 'Menggunakan anggota tubuh untuk pengembangan motorik kasar', 'aspek_id' => 2],
            
            ['nama_poin' => 'Mengenal benda berdasarkan fungsi', 'aspek_id' => 3],
            ['nama_poin' => 'Mengenal konsep bilangan', 'aspek_id' => 3],
            ['nama_poin' => 'Mengenal pola', 'aspek_id' => 3],
            
            ['nama_poin' => 'Memahami bahasa reseptif', 'aspek_id' => 4],
            ['nama_poin' => 'Mengungkapkan bahasa', 'aspek_id' => 4],
            ['nama_poin' => 'Mengenal keaksaraan awal', 'aspek_id' => 4],
            
            ['nama_poin' => 'Memiliki perilaku yang mencerminkan sikap percaya diri', 'aspek_id' => 5],
            ['nama_poin' => 'Memiliki perilaku yang mencerminkan sikap sabar', 'aspek_id' => 5],
            ['nama_poin' => 'Dapat bersosialisasi dengan teman', 'aspek_id' => 5],
            
            ['nama_poin' => 'Tertarik dengan aktivitas seni', 'aspek_id' => 6],
            ['nama_poin' => 'Menggunakan berbagai media dalam berkarya seni', 'aspek_id' => 6],
        ];

        foreach ($poins as $poin) {
            PoinAspek::create($poin);
        }
    }
}
