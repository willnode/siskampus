<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property int $id
 * @property string $nama
 * @property string $prodi
 * @property string $angkatan
 */
class Mahasiswa extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'angkatan' => 'integer',
    ];
}
