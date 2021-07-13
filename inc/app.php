<?php
declare(strict_types=1);
require'funciones.php';
require 'conf/database.php';
require __DIR__.'/../vendor/autoload.php';

use App\ActiveRecord;

$db = conectarDb();


ActiveRecord::SetDB($db);

