<?php

require_once("./../vendor/autoload.php");

use PhutureProof\SessionManager\Drivers\FileSystem as StorageSolution;
use PhutureProof\SessionManager;

$databaseDSN = 'mysql:dbname=sessionmanager;host=localhost';

$sessionSaveDirectory = __DIR__ . '/testsStorage';
$storageSolution = new StorageSolution($sessionSaveDirectory);
$sessionManager  = new SessionManager($storageSolution);

session_set_save_handler($sessionManager);

session_start();

$_SESSION['app-start-time'] = (new DateTime('now'))->format('YmdHis');