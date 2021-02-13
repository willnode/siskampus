<?php

namespace App\Libraries;

use Shared\Libraries\BaseExcelProcessor;

class DosenProcessor extends BaseExcelProcessor
{
    public $table = 'dosen';

    public $columns = [
        [
            'key' => 'nid',
            'title' => 'NIDN',
        ], [
            'key' => 'nama',
            'title' => 'Nama',
        ], [

            'key' => 'departemen',
            'title' => 'Departemen',
        ]
    ];
}
