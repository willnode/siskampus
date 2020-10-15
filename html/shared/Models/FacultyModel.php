<?php

namespace Shared\Models;

use CodeIgniter\Model;

class FacultyModel extends BaseModel
{
    protected $table      = 'master.faculty';
    protected $finalEntity = 'Shared\Entities\Faculty';
}
