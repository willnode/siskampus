<?php

namespace App\Entities;

use App\Models\ProposalModel;
use CodeIgniter\Entity;

/**
 * @property string $id
 * @property string $room_id
 * @property string $start_at
 * @property string $end_at
 * @property string $status
 * @property string $proposal_id
 * @property Proposal $proposal
 */
class Seminar extends Entity
{
    private $__cache_proposal;


    protected $dates = [
        'created_at',
        'updated_at',
        'start_at',
        'end_at',
    ];

    public function setProposal(Proposal $value)
    {
        $this->__cache_proposal = $value;
        $this->proposal_id = $value->id;
        return $this;
    }

    public function getProposal()
    {
        return $this->__cache_proposal ?: ($this->__cache_proposal = (new ProposalModel())->find($this->proposal_id));
    }
}
