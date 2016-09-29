<?php

require_once("./../vendor/autoload.php");

/**
 * Test factory
 */
use PhutureProof\SessionManager\Factories\SessionManagerFactory;

$config = [
    'driver' => 'mysql',
    'hostname' => 'localhost',
    'database' => 'sessionmanager',
    'username' => 'root',
    'password' => '',
    'savePath' => __DIR__ . '/testsStorage'
];
$sessionManager = SessionManagerFactory::withMySQL($config);
session_set_save_handler($sessionManager, true);
session_start();

$_SESSION['app-start-time'] = (new DateTime('now'))->format('YmdHis');