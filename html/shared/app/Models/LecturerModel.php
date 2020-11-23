<?php

namespace Shared\Models;

use Shared\Entities\Lecturer;

class LecturerModel extends BaseModel
{
    protected $table      = 'master.lecturer';
    protected $finalEntity = 'Shared\Entities\Lecturer';

    public function withDepartment($id)
    {
        $builder = $this->builder();
        if ($id) {
            $builder->where("data ->> 'department_id' = '$id'", null, false);
        }
        return $this;
    }
}
