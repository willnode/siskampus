<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property string $username
 * @property string $password
 * @property string $type
 * @property string $id
 */
class User extends Entity
{
    protected $casts = [
    ];
}