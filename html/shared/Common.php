<?php

function module_url($url)
{
    return STATIC_URL . '/modules/' . $url;
}

function static_url($url)
{
    return STATIC_URL . '/' . $url;
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
