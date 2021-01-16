<?php

namespace Config;

require_once SHAREDPATH . 'Config' . DIRECTORY_SEPARATOR . 'Services.php';

use Shared\Models\UserModel;
use Shared\Config\Services as SharedServices;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends SharedServices
{
	/** @return User */
	public static function user($getShared = true)
	{
		if ($getShared) {
			return static::getSharedInstance('user');
		}

		return (new UserModel())->find(Services::session()->login ?: 0);
	}
}
