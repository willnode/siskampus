<?php

namespace App\Controllers;

use App\Models\ProposalModel;
use Shared\Controllers\BaseController;
use Shared\Models\ExpertiseModel;
use Shared\Models\LecturerModel;

class Api extends BaseController
{
    public function expertises()
    {
        $data = (new ExpertiseModel())->withDepartment($this->request->getGet('department_id'))->findAll();
        return $this->response->setJSON($data);
    }

    public function lecturers()
    {
        $data = (new LecturerModel())->withDepartment($this->request->getGet('department_id'))->findAll();
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
        }, isset($_GET['mode']) ? (new ProposalModel())->findWithStatus($_GET['mode']) : (new ProposalModel())->findAll());
        return $this->response->setJSON($data);
    }
}
