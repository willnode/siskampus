<?php

namespace Shared\Libraries;

use CodeIgniter\Entity;
use Config\Database;

/**
 * @property-read SiteConfigShared $shared
 * @property-read SiteConfigMaster $master
 * @property-read SiteConfigResearch $research
 */
class SiteConfig
{
    private $cache = [];

    public function __get($name)
    {
        if (isset($this->cache[$name]))
            return $this->cache[$name];
        if (($db = Database::connect()->table('master.site')
            ->select("data->'$name' as config")
            ->get()->getRow()) && !empty($db->config)) {
            return $this->cache[$name] = new Entity(json_decode($db->config, true) ?: []);
        } else {
            return new Entity();
        }
    }

    public function save($name)
    {
        Database::connect()->table('master.site')->update([
            "data->'$name'" => json_encode($this->cache[$name] ?? [])
        ]);
    }
}

// Below are just for metadata fancies

/**
 * @property string[]|null $profile_allow_edit
 * @property array|bool|null $profile_unlock_filter
 */
class SiteConfigMaster extends Entity
{
}

/**
 * @property string|null $website
 * @property string|null $long_name
 * @property string|null $short_name
 */
class SiteConfigShared extends Entity
{
}

/**
 * @property bool|null $proposal_allow_entry
 */
class SiteConfigResearch extends Entity
{
}
