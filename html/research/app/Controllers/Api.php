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

    public function proposals()
    {
        if ($this->session->type !== 'operator') return;

        $data = array_map(function ($x) {
            $r = $x->toRawArray();
            $r['student'] = ($s = $x->student)->toRawArray();
            $r['student']['program'] = $s->program->toRawArray();
            unset($r['abstract']);
            unset($r['student_id']);
            return $r;
        }, isset($_GET['mode']) ?  (new ProposalModel())->findWithStatus($_GET['mode']) : (new ProposalModel())->findAll());
        return $this->response->setJSON($data);
    }
}
