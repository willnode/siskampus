<?php

namespace App\Controllers;

use App\Models\ProposalModel;
use App\Entities\Proposal;
use App\Entities\Seminar;
use App\Models\SeminarModel;
use Shared\Models\ExpertiseModel;
use Shared\Models\LecturerModel;
use Shared\Models\StudentModel;

class Api extends BaseController
{
    public function expertises()
    {
        $data = (new ExpertiseModel())->findWithDepartment($_GET['department_id']);
        return $this->response->setJSON($data);
    }

    public function lecturers()
    {
        $data = (new LecturerModel())->findWithDepartment($_GET['department_id']);
        foreach ($data as $key => $value) {
            $data[$key]->free = 10 - count((new ProposalModel())->findWithLecturer($value->id));
        }
        return $this->response->setJSON($data);
    }
}
