<?php

namespace Shared\Entities;

use CodeIgniter\Entity;

/**
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $avatar
 * @property string $password
 * @property string $role
 * @property int $otp
 */
class User extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'otp' => 'integer',
    ];

    public function sendVerifyEmail()
    {
        // TODO
    }
    public function getAvatarUrl()
    {
        if ($this->avatar)
            return '/uploads/avatar/' . $this->avatar;
        else
            return get_gravatar($this->email, 80, 'identicon');
    }
}
