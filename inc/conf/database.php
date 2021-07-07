<?php

function conectarDb():mysqli{
    try {
        $db = new mysqli('localhost','root','123456','bienesraices','3306');

        if ($db->connect_error) {
            error_log('Connection error: ' . $db->connect_error);
            $db=null;
        }
    } catch (\Throwable $th) {
        echo ($th);
    }
    return $db;
}