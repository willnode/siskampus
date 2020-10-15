<?php

namespace Shared\Models;

use CodeIgniter\Model;

class LecturerModel extends BaseModel
{
    protected $table      = 'master.lecturer';
    protected $finalEntity = 'Shared\Entities\Lecturer';
}
