<?php

use Config\Services;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */


require SHARED_PATH . 'Common.php';

function is_profile_free_edit($user, $config)
{
    if (is_bool($config)) {
        return $config;
    }
    else if (is_array($config)) {
        foreach ($config as $key => $value)
            if ($user->$key != $value)
                return false;
        return true;
    } else
        return false;
}
