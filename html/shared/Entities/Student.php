<?php

namespace Shared\Entities;

use CodeIgniter\Entity;
use Shared\Models\ProgramModel;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $status
 * @property string $birth_date
 * @property string $birth_place
 * @property string $class_of
 * @property string $program_id
 * @property string $type
 * @property Program $program
 */
class Student extends Entity
{
    public function getProgram()
    {
        return $this->program_id ? (new ProgramModel())->find($this->program_id) : new Program();
    }

    public function getType()
    {
        return 'student';
    }
}