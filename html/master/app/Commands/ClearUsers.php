<?php

namespace App\Commands;


use CodeIgniter\CLI\BaseCommand;
use Config\Database;

class ClearUsers extends BaseCommand
{
    protected $group       = 'gen';
    protected $name        = 'clear-user';
    protected $description = 'Clear All Users';

    public function run(array $params)
    {
        $db = Database::connect();
        $db->table('master.users')->truncate();
        echo 'OK';
    }
}
