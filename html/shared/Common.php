<?php

use Shared\Entities\Operator;

define('STATICPATH', implode(DIRECTORY_SEPARATOR, [realpath(ROOTPATH . '../'), 'static', '']));

function module_url($url)
{
    return STATIC_URL . '/modules/' . $url;
}

function static_url($url)
{
    return STATIC_URL . '/' . $url;
}

/** @param CodeIgniter\HTTP\Files\UploadedFile $file */
function set_file($directory, $file)
{
    if ($file->isValid() && !$file->hasMoved()) {
        $path = STATICPATH . 'uploads' . DIRECTORY_SEPARATOR . $directory;
        if (!is_dir($path)) {
            mkdir($path, 0750, true);
        }
        $file->move($path, date('Ymd') . '-' . $file->getClientName());
        return $file->getName();
    }
    return false;
}

function get_file($directory, $file, $collection = 'uploads')
{
    return STATIC_URL . "/$collection/$directory/$file";
}

function check_access($user, $check)
{
    return $user instanceof Operator && array_search($check, $user->access, true) !== false;
}

function tokenBasedLogin($token)
{
    $token = explode(':', base64_decode($token, true));
    if (count($token) !== 2) return null;
    $model = new Shared\Models\UserModel();
    /** @var Shared\Entities\User */
    $user = $model->find($token[0]);
    if (!$user || $user->otp != $token[1]) return null;
    $user->otp = null;
    $model->save($user);
    return $user;
}
