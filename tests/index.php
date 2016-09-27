<?php

require_once("./../vendor/autoload.php");

use PhutureProof\SessionManager\Drivers\FileSystem;
use PhutureProof\SessionManager;

$driver = new FileSystem(__DIR__ . '/testsStorage');
$sessionManager = new SessionManager($driver);

session_set_save_handler($sessionManager);
session_start();

$_SESSION['app-start-time'] = (new DateTime('now'))->format('YmdHis');