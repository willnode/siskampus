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
        if (count($params) !== 3)
        return;
        $db = Database::connect();
        $data = $db->table($params[0])->where('id NOT IN (SELECT id FROM users)')->get()->getResult();
        $data = array_map(function ($x) use ($params)
        {
            $bio = json_decode($x->bio);
            if (!$bio) {
                echo "Notice: $x->id has no valid bio\n";
            }
            return [
                'username' => $bio->{$params[1]} ?? $x->id,
                'password' => password_hash($bio->{$params[2]} ?? $params[2], PASSWORD_BCRYPT),
                'type' => $params[0],
                'id' => $x->id,
            ];
        }, $data);
        $db->table('users')->insertBatch($data);
        echo 'OK';
    }
}
