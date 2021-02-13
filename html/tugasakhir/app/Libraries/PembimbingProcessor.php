<?php

namespace App\Libraries;

use Shared\Libraries\BaseExcelProcessor;

class PembimbingProcessor extends BaseExcelProcessor
{

    public $table = 'pembimbing';

    public $columns = [
        [
            'key' => 'nid',
            'title' => 'NIDN',
        ], [
            'key' => 'nama',
            'title' => 'Nama',
        ], [
            'key' => 'hp',
            'title' => 'HP',
        ], [
            'key' => 'email',
            'title' => 'Email',
        ], [
            'key' => 'tema',
            'title' => 'Tema',
        ], [
            'key' => 'deskripsi',
            'title' => 'Deskripsi',
        ]
    ];
}
