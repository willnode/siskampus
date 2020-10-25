<?php

namespace App\Models;

use App\Entities\Seminar;
use CodeIgniter\Model;

class SeminarModel extends Model
{
    protected $table      = 'research.seminar';

    protected $allowedFields = [
        'proposal_id', 'location', 'start_at', 'end_at', 'status'
    ];

    protected $finalEntity = 'App\Entities\Seminar';

    /** @return Seminar[] */
    public function findWithStudent($student_id)
    {
        return $this->builder()->select('seminar.*')->join('research.proposal', 'proposal_id = proposal.id')
            ->where('student_id', $student_id)->get()->getResult($this->finalEntity);
    }

    /** @return Seminar[] */
    public function findWithLecturer($lecturer_id)
    {
        return $this->builder()->select('seminar.*')->join('research.proposal', 'proposal_id = proposal.id')
            ->where("'$lecturer_id' = ANY(lecturer_id)")->get()->getResult($this->finalEntity);
    }
}
