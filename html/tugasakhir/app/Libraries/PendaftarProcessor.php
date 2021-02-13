<?php

namespace App\Libraries;

use Shared\Libraries\BaseExcelProcessor;

class PendaftarProcessor extends BaseExcelProcessor
{

    public $table = 'pendaftar';

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
            'key' => 'hp',
            'title' => 'HP',
        ], [
            'key' => 'status',
            'title' => 'Status',
        ], [
            'key' => 'judul',
            'title' => 'Judul',
        ], [
            'key' => 'pembimbing',
            'title' => 'Pembimbing',
        ]
    ];
}
