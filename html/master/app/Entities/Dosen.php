<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property int $id
 * @property string $nama
 * @property string $departemen
 */
class Dosen extends Entity
{
    protected $casts = [
        'id' => 'integer',
    ];
}
