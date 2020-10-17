<?php

namespace App\Models;

use App\Entities\Proposal;
use CodeIgniter\Model;

class ProposalModel extends Model
{
    protected $table      = 'research.proposal';
    protected $allowedFields = [
        'student_id', 'expertise_id', 'lecturer_id', 'title', 'abstract', 'status', 'file'
    ];
    protected $returnType = 'App\Entities\Proposal';
    protected $useTimestamps = true;

    /** @return Proposal[] */
    public function findWithStudent($student_id)
    {
        return $this->builder()->where('student_id', $student_id)->get()->getResult($this->returnType);
    }

    /** @return Proposal[] */
    public function findWithLecturer($lecturer_id)
    {
        return $this->builder()->where("'$lecturer_id' = ANY(lecturer_id)")->get()->getResult($this->returnType);
    }
    /** @return Proposal[] */
    public function findWithStatus($status)
    {
        if ($status === 'pending') {
            return $this->builder()->like('status', $status, 'left')->get()->getResult($this->returnType);

        } else {

            return $this->builder()->where('status', $status)->get()->getResult($this->returnType);
        }
    }
}
