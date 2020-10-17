<?php

namespace Shared\Models;

use Shared\Entities\Lecturer;

class OperatorModel extends BaseModel
{
    protected $table      = 'master.operator';
    protected $finalEntity = 'Shared\Entities\Operator';

    /** @return Lecturer[] */
    public function findWithDepartment($id)
    {

        $eventData = $this->trigger('afterFind', ['id' => [], 'data' =>
        $this->builder()->where("data ->> 'department_id' = '$id'", null, false)
            ->get()->getResult('array')]);

        return $eventData['data'];
    }
}
