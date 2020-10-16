<?php

namespace App\Models;

use App\Entities\Proposal;
use CodeIgniter\Model;

class ProposalModel extends Model
{
    protected $table      = 'skripsi.proposal';
    protected $returnType = 'App\Entities\Proposal';

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
}
