<?php

namespace App\Entities;

use Shared\Entities\Config as SharedConfig;

/**
 * @property int $max_slot
 * @property string[] $categories
 */
class Config extends SharedConfig
{
    protected $casts = [
        'max_slot' => 'integer',
        'categories' => 'json',
    ];

    /** @return Config */
    public static function get()
    {
        return parent::get();
    }
}
