<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends BaseModel
{
    protected $table      = 'master.student';
    protected $returnType = 'App\Entities\Student';
}
