<?php

require_once("./../vendor/autoload.php");

use PhutureProof\SessionManager\Drivers\MySQL as StorageSolution;
use PhutureProof\SessionManager;

$storageSolutionDSN = 'mysql:dbname=sessionmanager;host=localhost';

$database       = new PDO($storageSolutionDSN, 'root', '');
$driver         = new StorageSolution($database);
$sessionManager = new SessionManager($driver);

session_set_save_handler($sessionManager);

session_start();

$_SESSION['app-start-time'] = (new DateTime('now'))->format('YmdHis');