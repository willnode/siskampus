<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property string $username
 * @property string $password
 * @property string $type
 * @property string $id
 * @property string $otp
 */
class User extends Entity
{
    protected $casts = [
    ];
}