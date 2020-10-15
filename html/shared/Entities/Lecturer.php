<?php

namespace Shared\Entities;

use CodeIgniter\Entity;
use Shared\Models\DepartmentModel;

/**
 * @property string $id
 * @property string $name
 * @property string $status
 * @property string $department_id
 * @property Department $department
 */
class Lecturer extends Entity
{
    public function getDepartment()
    {
        return $this->department_id ? (new DepartmentModel())->find($this->department_id) : new Department();
    }
}