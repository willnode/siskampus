<?php

namespace App\Entities;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property int $max_slot
 * @property string[] $categories
 */
class ConfigEntity extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'max_slot' => 'integer',
        'categories' => 'json',
    ];
}
