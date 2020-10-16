<?php

namespace App\Entities;

use CodeIgniter\Entity;
use Shared\Entities\Expertise;
use Shared\Entities\Lecturer;
use Shared\Entities\Student;
use Shared\Models\ExpertiseModel;
use Shared\Models\LecturerModel;
use Shared\Models\StudentModel;

/**
 * @property string $id
 * @property string $student_id
 * @property string $expertise_id
 * @property string[] $lecturer_id
 * @property Student $student
 * @property Expertise $expertise
 * @property Lecturer[] $lecturer
 * @property string $title
 * @property string $abstract
 * @property string $status
 */
class Proposal extends Entity
{
    public function getStudent()
    {
        return $this->student_id ? (new StudentModel())->find($this->student_id) : new Student();
    }

    public function getExpertise()
    {
        return $this->expertise_id ? (new ExpertiseModel())->find($this->expertise_id) : new Expertise();
    }

    public function getLecturer()
    {
        return (new LecturerModel())->find($this->getLecturerId());
    }

    public function getLecturerId()
    {
        return explode(',', trim($this->attributes['lecturer_id'] ?? '', '{}'));
    }

    public function setLecturerId($x)
    {
        $this->attributes['lecturer_id'] = '{' . implode(',', $x) . '}';
    }
}
