<?php

namespace Shared\Models;

class RoomModel extends BaseModel
{
    protected $table      = 'master.room';
    protected $finalEntity = 'Shared\Entities\Room';

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
