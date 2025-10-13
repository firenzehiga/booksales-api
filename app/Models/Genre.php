<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
        [
            'name' => 'Petualangan',
            'description' => 'Buku yang berisi tentang kisah petualangan dan perjalanan seru.'
        ],
        [
            'name' => 'Pengembangan Diri',
            'description' => 'Buku yang berisi tentang cara-cara untuk meningkatkan kualitas diri.'
        ],
        [
            'name' => 'Manga',
            'description' => 'Buku bergaya Jepang yang biasanya berupa komik atau novel grafis.'
        ],
        [
            'name' => 'Fantasi',
            'description' => 'Buku yang berisi tentang dunia imajinatif dengan elemen magis atau supernatural.'
        ],
        [
            'name' => 'Petualangan Laut',
            'description' => 'Buku yang berisi tentang kisah petualangan di lautan, seringkali melibatkan bajak laut atau penjelajahan.'
        ],
    ];

    public function getGenres()
    {
        return $this->genres;
    }
}
