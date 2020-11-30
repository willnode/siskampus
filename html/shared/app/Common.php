<?php

use Config\Services;
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
    return null;
}

function try_set_file(&$object, $name, $directory)
{
    $file = Services::request()->getFile($name);
    if ($file && ($r = set_file($directory, $file))) {
        if (is_object($object))
            $object->$name = $r;
        elseif (is_array($object))
            $object[$name] = $r;
    } elseif (Services::request()->getPost($name) === 'delete') {
        if (is_object($object))
            $object->$name = '';
        elseif (is_array($object))
            $object[$name] = '';
    } else {
        if (is_object($object))
            unset($object->$name);
        elseif (is_array($object))
            unset($object[$name]);
    }
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

function shared_view(string $name, array $data = [], array $options = []): string
{
    $renderer = Services::shared_renderer();

    $saveData = config(View::class)->saveData;

    return $renderer->setData($data, 'raw')
        ->render($name, $options, $saveData);
}

function pg_array_encode($set)
{
    settype($set, 'array'); // can be called with a scalar or array
    $result = array();
    foreach ($set as $t) {
        if (is_array($t)) {
            $result[] = pg_array_encode($t);
        } else {
            $t = str_replace('"', '\\"', $t); // escape double quote
            if (!is_numeric($t)) // quote only non-numeric values
                $t = '"' . $t . '"';
            $result[] = $t;
        }
    }
    return '{' . implode(",", $result) . '}'; // format
}

function pg_array_decode($s, $start = 0, &$end = null)
{
    if (empty($s) || $s[0] != '{') return [];
    $return = array();
    $string = false;
    $quote = '';
    $len = strlen($s);
    $v = '';
    for ($i = $start + 1; $i < $len; $i++) {
        $ch = $s[$i];

        if (!$string && $ch == '}') {
            if ($v !== '' || !empty($return)) {
                $return[] = $v;
            }
            $end = $i;
            break;
        } elseif (!$string && $ch == '{') {
            $v = pg_array_decode($s, $i, $i);
        } elseif (!$string && $ch == ',') {
            $return[] = $v;
            $v = '';
        } elseif (!$string && ($ch == '"' || $ch == "'")) {
            $string = true;
            $quote = $ch;
        } elseif ($string && $ch == $quote && $s[$i - 1] == "\\") {
            $v = substr($v, 0, -1) . $ch;
        } elseif ($string && $ch == $quote && $s[$i - 1] != "\\") {
            $string = false;
        } else {
            $v .= $ch;
        }
    }

    return $return;
}

function find_with_filter(\CodeIgniter\Model $model)
{
    $req = Services::request();
    $page = intval($req->getGet('page'));
    $size = intval($req->getGet('size'));
    $offset = intval($req->getGet('offset'));
    if ($size === 0) $size = 2;
    else if ($size < 0) $size = 0;
    if ($offset === 0)
        $offset = max(0, $page - 1) * $size;
    // if ($offset > 0)
    $c = $model->countAllResults(false);
    // getting the C makes this easier to reverse
    $o = $c - ($offset + 1) - ($c % $size);
    $r = $model->findAll($size + min(0, $o), max(0, $o));
    $r = array_reverse($r);
    // generate pagination
    $_SERVER['pagination'] = [
        'page' => ($size == 0 ? 0 : floor($offset / $size)) + 1,
        'max' => isset($c) ? ceil($c / $size) : ceil((count($r) + 1) / $size),
        'certain' => isset($c),
    ];
    return $r;
}
