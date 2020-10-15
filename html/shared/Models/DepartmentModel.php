<?php

namespace Shared\Models;

use CodeIgniter\Model;

class DepartmentModel extends BaseModel
{
    protected $table      = 'master.department';
    protected $finalEntity = 'Shared\Entities\Department';
}
