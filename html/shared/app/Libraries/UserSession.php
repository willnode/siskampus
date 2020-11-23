<?php

namespace Shared\Libraries;

use CodeIgniter\Entity;
use CodeIgniter\Model;
use Shared\Entities\User;
use Shared\Models\LecturerModel;
use Shared\Models\OperatorModel;
use Shared\Models\StudentModel;
use Shared\Models\UserModel;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $avatar
 * @property string|null $type
 */
class UserSession
{
    /**
     * @var Entity|null
     */
    protected $entity = null;

    protected $session = null;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        if ($this->session->id && $this->session->type) {
            $this->entity = $this->getModel()->find($this->session->id);
        }
    }

    /**
     * @return Model|null
     */
    public function getModel()
    {
        switch ($this->session->type) {
            case 'student':
                return (new StudentModel());
            case 'lecturer':
                return (new LecturerModel());
            case 'operator':
                return (new OperatorModel());
            default:
                return null;
        }
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        return $this->entity ? (new UserModel())->find($this->entity->id) : null;
    }

    /**
     * @return Entity|null
     */
    public function getEntity()
    {
        return $this->entity;
    }

    public function __get(string $name)
    {
        return $this->entity->$name ?? null;
    }

    public function __set(string $name, $val)
    {
        $this->entity && ($this->entity->$name = $val);
    }

    public function save()
    {
        $this->entity && $this->getModel()->save($this->entity);
    }

    public function loginDirectly($id, $type)
    {
        $this->session->id = $id;
        $this->session->type = $type;
        $this->entity = $this->getModel()->find($this->session->id);
    }

    public function logout()
    {
        $this->session->destroy();
        $this->entity = null;
    }
}
