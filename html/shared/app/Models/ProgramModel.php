<?php

namespace Shared\Models;

class ProgramModel extends BaseModel
{
    protected $table      = 'master.program';
    protected $finalEntity = 'Shared\Entities\Program';
    protected $i18nFields = ['name'];

    public function withDepartment($id)
    {
        $builder = $this->builder();
        if ($id) {
            $builder->where("data ->> 'department_id' = '$id'", null, false);
        }
        return $this;
    }
}
