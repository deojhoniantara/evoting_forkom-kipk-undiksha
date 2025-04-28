<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidate;

class CandidateSeeder extends Seeder
{
    public function run()
    {
        $candidates = [
            [
                'name' => 'Kandidat 1',
                'photo' => null,
                'vision' => 'Mewujudkan organisasi yang profesional, transparan, inovatif, serta berorientasi pada kesejahteraan seluruh anggota.',
                'mission' => '
                    1. Meningkatkan kualitas komunikasi internal melalui penggunaan teknologi dan forum rutin.
                    2. Menyelenggarakan program pengembangan kapasitas anggota berbasis kebutuhan aktual.
                    3. Memperkuat solidaritas dan rasa memiliki antar anggota melalui berbagai kegiatan kolaboratif dan sosial.
                '
            ],
            [
                'name' => 'Kandidat 2',
                'photo' => null,
                'vision' => 'Membangun organisasi yang inklusif, progresif, dan menjadi pusat pengembangan potensi setiap anggota.',
                'mission' => '
                    1. Menyediakan platform yang mendukung kreativitas dan inovasi anggota secara berkelanjutan.
                    2. Menjalin dan memperluas jejaring kerja sama dengan berbagai pihak eksternal untuk mendukung program kerja.
                    3. Membangun budaya organisasi yang adaptif, terbuka terhadap perubahan, dan responsif terhadap tantangan zaman.
                '
            ],
            [
                'name' => 'Kandidat 3',
                'photo' => null,
                'vision' => 'Menjadi pemimpin yang mampu menginspirasi perubahan positif melalui kepemimpinan kolaboratif, beretika, dan berintegritas tinggi.',
                'mission' => '
                    1. Meningkatkan partisipasi aktif seluruh anggota dalam setiap kegiatan organisasi.
                    2. Mengoptimalkan pengelolaan sumber daya organisasi untuk mencapai efektivitas dan efisiensi.
                    3. Menjaga, menerapkan, dan menginternalisasi nilai-nilai etika dalam setiap aspek kegiatan organisasi.
                '
            ],
        ];
        

        foreach ($candidates as $candidate) {
            Candidate::create($candidate);
        }
    }
}

