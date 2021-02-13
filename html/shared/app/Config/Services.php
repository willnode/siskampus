<?php

namespace Shared\Config;

use CodeIgniter\Config\Services as CoreServices;
use Shared\Entities\User;
use Shared\Models\UserModel;

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
class Services extends CoreServices
{
	public static function shared_renderer(string $viewPath = null, $config = null, bool $getShared = true)
	{
		if ($getShared)
		{
			return static::getSharedInstance('shared_renderer', $viewPath, $config);
		}

		if (is_null($viewPath))
		{
			$viewPath = SHARED_PATH.'Views';
		}

		return new \CodeIgniter\View\View(new \Config\View(), $viewPath, static::locator(), CI_DEBUG, static::logger());
	}

	/** @return User */
	public static function user($getShared = true)
	{
		if ($getShared) {
			return static::getSharedInstance('user');
		}

		return (new UserModel())->find(Services::session()->login ?: 0);
	}
}
