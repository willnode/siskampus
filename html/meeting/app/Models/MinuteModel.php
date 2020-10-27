<?php

namespace App\Models;

use App\Entities\Minute;
use CodeIgniter\Model;

class MinuteModel extends Model
{
    protected $table      = 'meeting.minute';
    protected $allowedFields = [
        'department_id', 'title', 'details', 'notes', 'documents', 'galleries',
        'presents', 'time', 'duration', 'room_id', 'status'
    ];
    protected $returnType = 'App\Entities\Minute';
    protected $useTimestamps = true;

    /** @return Minute[] */
    public function findWithLecturer($lecturer_id)
    {
        return $this->builder()->where("'$lecturer_id' = ANY(lecturer_id)")->get()->getResult($this->returnType);
    }
}

