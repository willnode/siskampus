<?php

namespace App\Entities;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property int $user_id
 * @property string $judul
 */
class Entri extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];
}
