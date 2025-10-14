<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'Leila S. Chudori',
            'bio' => 'Penulis fiksi petualangan yang sering mengeksplorasi tema pulang dan pencarian jati diri.',
            'photo' => 'leila_chudori.jpg',
        ]);
        Author::create([
            'name' => 'Mark Manson',
            'bio' => 'Penulis nonfiksi dan pengamat kehidupan yang menulis buku pengembangan diri dan filosofi hidup.',
            'photo' => 'mark_manson.jpg',
        ]);
        Author::create([
            'name' => 'Masashi Kishimoto',
            'bio' => 'Penulis/ilustrator bergaya manga yang fokus pada kisah pertumbuhan, persahabatan, dan jalan ninja.',
            'photo' => 'masashi_kishimoto.jpg',
        ]);
        Author::create([
            'name' => 'J.K. Rowling',
            'bio' => 'Penulis fiksi fantasi yang terkenal dengan seri Harry Potter, mengeksplorasi dunia sihir dan petualangan.',
            'photo' => 'j.k_rowling.jpg',
        ]);
        Author::create([
            'name' => 'Eiichiro Oda',
            'bio' => 'Penulis petualangan epik yang sering menulis tentang lautan, perjalanan panjang, dan jiwa penjelajah.',
            'photo' => 'eiichiro_oda.jpg',
        ]);
    }
}
