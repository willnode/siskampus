<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property string $short_name
 * @property string $long_name
 * @property string $website
 */
class Site extends Entity
{
    protected $casts = [
        'short_name' => 'string',
        'long_name' => 'string',
        'website' => 'string',
    ];
}