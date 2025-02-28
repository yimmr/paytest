<?php

define('STORAGE_PATH', __DIR__.DIRECTORY_SEPARATOR.'storage');

function storagePath(...$path)
{
    return implode(DIRECTORY_SEPARATOR, [STORAGE_PATH, ...$path]);
}

function saveRequest()
{
    if (!is_dir(STORAGE_PATH)) {
        mkdir(STORAGE_PATH, 0755);
    }
    $data = [
        'time'    => time(),
        'time'    => date('Y-m-d H:i:s'),
        'ip'      => $_SERVER['REMOTE_ADDR'] ?? '',
        'method'  => $_SERVER['REQUEST_METHOD'] ?? 'GET',
        'url'     => $_SERVER['REQUEST_URI'] ?? '',
        'referer' => $_SERVER['HTTP_REFERER'] ?? '',
        'get'     => $_GET,
        'post'    => $_POST,
        'files'   => $_FILES,
    ];
    $json = json_encode($data);
    file_put_contents(storagePath(date('Y-m-d_H-i-s').'.json'), $json);
    return $data;
}
