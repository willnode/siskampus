<?php

namespace Shared\Models;

use Shared\Entities\Expertise;

class ExpertiseModel extends BaseModel
{
    protected $table      = 'master.expertise';
    protected $finalEntity = 'Shared\Entities\Expertise';

    public function withDepartment($id)
    {
        $builder = $this->builder();
        if ($id) {
            $builder->where("data ->> 'department_id' = '$id'", null, false);
        }
        return $this;
    }
}
