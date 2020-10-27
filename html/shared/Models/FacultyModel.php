<?php

namespace Shared\Models;

class FacultyModel extends BaseModel
{
    protected $table      = 'master.faculty';
    protected $finalEntity = 'Shared\Entities\Faculty';
    protected $i18nFields = ['name'];
}
