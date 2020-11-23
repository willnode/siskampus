<?php

namespace Shared\Models;

use Shared\Entities\Lecturer;

class OperatorModel extends BaseModel
{
    protected $table      = 'master.operator';
    protected $finalEntity = 'Shared\Entities\Operator';

    public function withDepartment($id)
    {
        $builder = $this->builder();
        if ($id) {
            $builder->where("data ->> 'department_id' = '$id'", null, false);
        }
        return $this;
    }
}
