<?php

namespace App\Models;

use App\Entities\Site;
use Config\Database;

class SiteModel
{

    public function get()
    {
        return new Site(json_decode(Database::connect()->table('site')->get()->getRowArray()['config'], true));
    }

    /**
     * @param Site $data
     */
    public function set($data)
    {
        Database::connect()->table('site')->update(['config' => json_encode($data->toRawArray())], []);
    }
}
