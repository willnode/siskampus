<?php

use CodeIgniter\Entity;
use Config\Services;
use Config\View;

define('STATICPATH', implode(DIRECTORY_SEPARATOR, [realpath(ROOTPATH . '../'), 'static', '']));

function module_url($url)
{
    return STATIC_URL . '/modules/' . $url;
}

function static_url($url)
{
    return STATIC_URL . '/' . $url;
}

/**
 * @param string|null $file
 */
function post_file(Entity $entity, $name, string $folder = null)
{
    if (!is_dir($path  = STATICPATH . implode(DIRECTORY_SEPARATOR, ['uploads', $folder ?? $name, '']))) {
        mkdir($path, 0775, true);
    }
    $req = Services::request();
    $file = $req->getFile($name);
    if ($file && $file->isValid() && $file->move($path, date('Ymd').'-'.$file->getName())) {
        if ($entity->{$name} && is_file($path . $entity->{$name})) {
            unlink($path . $entity->{$name});
        }
        $entity->{$name} = $file->getName();
    } else if ($req->getPost('_' . $name) === 'delete') {
        if ($entity->{$name} && is_file($path . $entity->{$name})) {
            unlink($path . $entity->{$name});
        }
        $entity->{$name} = null;
    }
}

function get_file($directory, $file, $collection = 'uploads')
{
    return STATIC_URL . "/$collection/$directory/$file";
}


function shared_view(string $name, array $data = [], array $options = []): string
{
    $renderer = Services::shared_renderer();

    $saveData = config(View::class)->saveData;

    return $renderer->setData($data, 'raw')
        ->render($name, $options, $saveData);
}

function find_with_filter(\CodeIgniter\Model $model)
{
    $req = Services::request();
    $page = intval($req->getGet('page'));
    $size = intval($req->getGet('size'));
    $offset = intval($req->getGet('offset'));
    if ($size === 0) $size = 500;
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

function get_gravatar($email, $s = 80, $d = 'mp', $r = 'g')
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    return $url;
}

function set_excel_header($filename)
{
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=" . rawurlencode(date('Ymd').'-'.$filename) . ".xlsx");
}
