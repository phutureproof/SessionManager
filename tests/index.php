<?php

require_once("./../vendor/autoload.php");

use PhutureProof\SessionManager\Drivers\MySQL as StorageSolution;
use PhutureProof\SessionManager;

$databaseDSN = 'mysql:dbname=sessionmanager;host=localhost';

$database        = new PDO($databaseDSN, 'root', '');
$storageSolution = new StorageSolution($database);
$sessionManager  = new SessionManager($storageSolution);

session_set_save_handler($sessionManager);

session_start();

$_SESSION['app-start-time'] = (new DateTime('now'))->format('YmdHis');