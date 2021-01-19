<?php

namespace App\Entities;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property string $nid
 * @property string $nama
 * @property string $hp
 * @property string $email
 * @property string $tema
 */
class Pembimbing extends Entity
{
    protected $casts = [
        'id' => 'integer',
    ];
}
