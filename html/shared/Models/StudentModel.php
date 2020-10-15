<?php

namespace Shared\Models;

use CodeIgniter\Model;

class StudentModel extends BaseModel
{
    protected $table      = 'master.student';
    protected $finalEntity = 'Shared\Entities\Student';
}
