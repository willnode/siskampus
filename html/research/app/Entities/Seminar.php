<?php

namespace App\Entities;

use App\Models\ProposalModel;
use CodeIgniter\Entity;

/**
 * @property string $id
 * @property string $location
 * @property string $start_at
 * @property string $end_at
 * @property string $status
 * @property string $proposal_id
 * @property Proposal $proposal
 */
class Seminar extends Entity
{
    public function getProposal()
    {
        return (new ProposalModel())->find($this->proposal_id);
    }
}
