<?php

namespace App\Libraries;

use Shared\Libraries\BaseExcelProcessor;

class MahasiswaProcessor extends BaseExcelProcessor
{
    public $table = 'mahasiswa';

    public $columns = [
        [
            'key' => 'nim',
            'title' => 'NIM',
        ], [
            'key' => 'nama',
            'title' => 'Nama',
        ], [
            'key' => 'prodi',
            'title' => 'Prodi',
        ], [
            'key' => 'angkatan',
            'title' => 'Angkatan',
        ]
    ];
}
