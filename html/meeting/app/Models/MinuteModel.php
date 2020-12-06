<?php

namespace App\Models;

use App\Entities\Minute;
use CodeIgniter\Model;

class MinuteModel extends Model
{
    protected $table      = 'meeting.minute';
    protected $allowedFields = [
        'department_id', 'title', 'details', 'note', 'documents', 'galleries',
        'participants', 'time', 'room_id', 'status', 'reporter', 'chairman'
    ];
    protected $returnType = 'App\Entities\Minute';
    protected $useTimestamps = true;

    /** @return Minute[] */
    public function findWithLecturer($lecturer_id)
    {
        return $this->builder()->where("'$lecturer_id' = ANY(lecturer_id)")->get()->getResult($this->returnType);
    }

    public function processWeb($id)
    {
        if ($id === null) {
			$minute = (new Minute($_POST));
            $id = $this->insert($minute);
            return $id;
		} else if ($minute = $this->find($id)) {
			/** @var Minute $minute */
			$minute->fill($_POST);
			if ($minute->hasChanged()) {
				$this->save($minute);
			}
            return $id;
		}
        return false;
    }
}

