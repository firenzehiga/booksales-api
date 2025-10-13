<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
        [
            'name' => 'Leila S. Chudori',
            'bio' => 'Penulis fiksi petualangan yang sering mengeksplorasi tema pulang dan pencarian jati diri.',
            'photo' => 'leila_chudori.jpg',

        ],
        [
            'name' => 'Mark Manson',
            'bio' => 'Penulis nonfiksi dan pengamat kehidupan yang menulis buku pengembangan diri dan filosofi hidup.',
            'photo' => 'mark_manson.jpg',

        ],
        [
            'name' => 'Masashi Kishimoto',
            'bio' => 'Penulis/ilustrator bergaya manga yang fokus pada kisah pertumbuhan, persahabatan, dan jalan ninja.',
            'photo' => 'masashi_kishimoto.jpg',

        ],
        [
            'name' => 'J.K. Rowling',
            'bio' => 'Penulis fiksi fantasi yang terkenal dengan seri Harry Potter, mengeksplorasi dunia sihir dan petualangan.',
            'photo' => 'j.k_rowling.jpg',

        ],
        [
            'name' => 'Eiichiro Oda',
            'bio' => 'Penulis petualangan epik yang sering menulis tentang lautan, perjalanan panjang, dan jiwa penjelajah.',
            'photo' => 'eiichiro_oda.jpg',

        ],
    ];

    public function getAuthors()
    {
        return $this->authors;
    }
}
