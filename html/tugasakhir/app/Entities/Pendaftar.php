<?php

namespace App\Entities;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property string $nim
 * @property string $nama
 * @property string $prodi
 * @property string $hp
 * @property string $status
 * @property string $judul
 * @property string $pembimbing
 * @property Time $created_at
 * @property Time $updated_at
 */
class Pendaftar extends Entity
{
    protected $casts = [
        'id' => 'integer',
    ];
}
