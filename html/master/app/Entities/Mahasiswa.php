<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property int $nim
 * @property string $nama
 * @property string $prodi
 * @property string $angkatan
 */
class Mahasiswa extends Entity
{
    protected $casts = [
        'angkatan' => 'integer',
    ];
}
