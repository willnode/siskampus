<?php

namespace Shared\Models;

use Shared\Entities\Lecturer;

class LecturerModel extends BaseModel
{
    protected $table      = 'master.lecturer';
    protected $finalEntity = 'Shared\Entities\Lecturer';

    /** @return Lecturer[] */
    public function findWithDepartment($id)
    {

        $eventData = $this->trigger('afterFind', ['id' => [], 'data' =>
        $this->builder()->where("data ->> 'department_id' = '$id'", null, false)
            ->get()->getResult('array')]);

        return $eventData['data'];
    }
}
