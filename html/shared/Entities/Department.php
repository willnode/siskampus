<?php

namespace Shared\Entities;

use CodeIgniter\Entity;
use Shared\Models\FacultyModel;

/**
 * @property string $id
 * @property string $name
 * @property string $faculty_id
 * @property Faculty $faculty
 */
class Department extends Entity
{
    public function getFaculty()
    {
        return $this->faculty_id ? (new FacultyModel())->find($this->faculty_id) : new Faculty();
    }
}