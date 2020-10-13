<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $allowedFields = [];
    protected $primaryKey = 'username';
    protected $returnType = 'App\Entities\User';
}
