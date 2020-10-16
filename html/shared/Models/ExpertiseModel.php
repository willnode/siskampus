<?php

namespace Shared\Models;

use Shared\Entities\Expertise;

class ExpertiseModel extends BaseModel
{
    protected $table      = 'master.expertise';
    protected $finalEntity = 'Shared\Entities\Expertise';

    /** @return Expertise[] */
    public function findWithDepartment($id)
    {

        $eventData = $this->trigger('afterFind', ['id' => [], 'data' =>
        $this->builder()->where("data ->> 'department_id' = '$id'", null, false)
            ->get()->getResult('array')]);

        return $eventData['data'];
    }
}
