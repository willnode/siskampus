<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property string $id
 * @property string $name
 * @property string $status
 */
class Bio extends Entity
{
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'status' => 'string',
    ];
}