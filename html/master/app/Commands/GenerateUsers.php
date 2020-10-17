<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use Config\Database;

class GenerateUsers extends BaseCommand
{
    protected $group       = 'gen';
    protected $name        = 'generate-user';
    protected $description = 'Generate Users if not exist';

    public function run(array $params)
    {
        $db = Database::connect();
        foreach (['student' => 'id', 'lecturer' => 'id', 'operator' => 'id'] as $type => $kind) {
            $data = $db->table('master.' . $type)->where('id NOT IN (SELECT username FROM master.users)')->get()->getResult();
            $data = array_map(function ($x) use ($type) {
                $bio = json_decode($x->data);
                if (!$bio) {
                    echo "Notice: $x->id has no valid bio\n";
                }
                return [
                    'username' => $x->id,
                    'password' => password_hash(/*$bio->{$params[1]} ?? */$x->id, PASSWORD_BCRYPT),
                    'type' => $type,
                ];
            }, $data);
            if ($data)
                $db->table('master.users')->insertBatch($data);
        }
        echo 'OK';
    }
}
