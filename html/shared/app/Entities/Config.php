<?php

namespace Shared\Entities;

use CodeIgniter\Entity;
use Config\Database;

class Config extends Entity
{
    protected $casts = [];

    private static ?Config $cache = null;

    public static function get()
    {
        if (static::$cache)
            return static::$cache;
        $d = Database::connect()->table('config')->get()->getResult();
        $c = new \App\Entities\Config();
        foreach ($d as $r) {
            $c->attributes[$r->key] = $r->value;
        }
        $c->original = $c->attributes;
        return static::$cache = $c;
    }

    public function save()
    {
        $table = Database::connect()->table('config');
        foreach ($this->toArray(true) as $key => $value) {
            if (isset($this->casts[$key]))
                $table->replace(['key' => $key, 'value' => $value]);
        }
    }
}
