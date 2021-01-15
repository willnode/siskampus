<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;
use Config\Services;

class UserModel extends Model
{
    public static $roles = [
        'mahasiswa',
        'dosen',
        'operator',
    ];
    protected $table         = 'user';
    protected $allowedFields = [
        'name', 'username', 'password', 'avatar', 'role', 'otp'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\User';
    protected $useTimestamps = false;

    /** @return User|null */
    public function atEmail($username)
    {
        $this->builder()->where('username', $username);
        return $this->find()[0] ?? null;
    }

    public function login(User $data)
    {
        $s = Services::session();
        $s->set('login', $data->id);
    }

    /** @return int|null */
    public function register($data, $thenLogin = true)
    {
        $data = array_intersect_key($data, array_flip(
            ['name', 'username', 'password']
        ));
        $data['lang'] = Services::request()->getLocale();
        if (!empty($data['password']))
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        if ($this->save($data)) {
            if ($thenLogin) {
                Services::session()->set('login', $this->insertID);
            }
            return $this->insertID;
        }
        return null;
    }

    public function processWeb($id)
    {
        if ($id === null) {
            $item = (new User($_POST));
            post_file($item, 'avatar');
            $item->password = password_hash($item->password, PASSWORD_BCRYPT);
            $id = $this->insert($item);
            return $id;
        } else if ($item = $this->find($id)) {
            /** @var User $item */
            $item->fill($_POST);
            post_file($item, 'avatar');
            if ($item->hasChanged()) {
                if ($item->hasChanged('password')) {
                    $item->password = password_hash($item->password, PASSWORD_BCRYPT);
                }
                $this->save($item);
            }
            return $id;
        }
        return false;
    }
}
