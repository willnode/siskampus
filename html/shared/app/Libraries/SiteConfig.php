<?php

namespace Shared\Libraries;

use CodeIgniter\Entity;
use Config\Database;

/**
 * @property SiteConfigShared $shared
 * @property SiteConfigMaster $master
 * @property SiteConfigResearch $research
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
 * @property string[]|null $student_editable_columns
 * @property string[]|null $lecturer_editable_columns
 * @property string[]|null $operator_editable_columns
 * @property array|bool|null $student_editable_filters
 * @property array|bool|null $lecturer_editable_filters
 * @property array|bool|null $operator_editable_filters
 * @property string[]|null $operator_list_access
 */
class SiteConfigMaster extends Entity
{
}

/**
 * @property string|null $website
 * @property string|null $long_name
 * @property string|null $short_name
 * @property string|null $navbar_theme
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
