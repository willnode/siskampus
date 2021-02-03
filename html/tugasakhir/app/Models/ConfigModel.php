<?php

namespace App\Models;

use App\Entities\ConfigEntity;
use App\Entities\Pembimbing;
use CodeIgniter\Model;
use Config\Services;

class ConfigModel extends Model
{
    protected $table         = 'config';
    protected $allowedFields = [
        'max_slot', 'categories'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\ConfigEntity';

    public function processWeb()
    {
        if ($item = $this->find(1)) {
            $item->fill($_POST);
            $item->categories = array_map(function ($x) {
                return strtolower(trim($x));
            }, explode("\n", trim($_POST['categories'])));
            if ($item->hasChanged()) {
                $this->save($item);
            }
            return true;
        }
        return false;
    }

    static $config;

    /** @return ConfigEntity */
    public static function get()
    {
        return static::$config ? static::$config : (static::$config = (new ConfigModel())->find(1));
    }
}
