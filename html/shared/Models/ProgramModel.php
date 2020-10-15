<?php

namespace Shared\Models;

use CodeIgniter\Model;

class ProgramModel extends BaseModel
{
    protected $table      = 'master.program';
    protected $finalEntity = 'Shared\Entities\Program';
}
