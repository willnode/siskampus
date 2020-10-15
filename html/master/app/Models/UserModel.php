<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'master.users';
    protected $allowedFields = [ 'otp', 'password' ];
    protected $primaryKey = 'username';
    protected $returnType = 'App\Entities\User';
}
