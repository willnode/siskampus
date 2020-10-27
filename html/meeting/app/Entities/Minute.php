<?php

namespace App\Entities;

use CodeIgniter\Entity;
use MinutePerson;
use Shared\Entities\Department;
use Shared\Entities\Room;
use Shared\Models\DepartmentModel;
use Shared\Models\RoomModel;

/**
 * @property int $id
 * @property string $title
 * @property string $note
 * @property string[] $documents
 * @property string[] $galleries
 * @property MinutePerson[] $participants
 * @property MinutePerson $chairman
 * @property MinutePerson $reporter
 * @property Time $time
 * @property Time $updated_at
 * @property Time $created_at
 * @property int $duration seconds
 * @property string $room_id
 * @property Room $room
 * @property string $department_id
 * @property Department $department
 */
class Minute extends Entity
{

    protected $dates = [
        'created_at',
        'updated_at',
        'time',
    ];

    protected $casts = [
        'participants' => 'json',
        'chairman' => 'json',
        'reporter' => 'json',
    ];

    public function getRoom()
    {
        return $this->room_id ? (new RoomModel())->find($this->room_id) : new Room();
    }

    public function getDepartment()
    {
        return $this->department_id ? (new DepartmentModel())->find($this->department_id) : new Department();
    }

    public function getChairman()
    {
        return new MinutePerson(json_decode($this->attributes['chairman'] ?? '{}'));
    }

    public function getReporter()
    {
        return  new MinutePerson(json_decode($this->attributes['reporter'] ?? '{}'));
    }

    public function getParticipants()
    {
        return array_map(function ($x) {
            return new MinutePerson($x ?: []);
        }, json_decode($this->attributes['participants'] ?? '[]'));
    }
}
