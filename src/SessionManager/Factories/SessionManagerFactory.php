<?php

namespace PhutureProof\SessionManager\Factories;

use PhutureProof\SessionManager;
use PhutureProof\SessionManager\Drivers\MySQL;
use PhutureProof\SessionManager\Drivers\FileSystem;

class SessionManagerFactory
{
    public static function withMySQL($config)
    {
        if(!isset($config['driver'], $config['hostname'], $config['database'], $config['username'], $config['password']))
        {
            throw new \InvalidArgumentException('Missing configuration array argument.');
        }
        extract($config);
        $dsn = "{$driver}:dbname={$database};host={$hostname}";
        $pdo = new \PDO($dsn, $username, $password);
        $storage = new MySQL($pdo);
        return new SessionManager($storage);
    }

    public static function withFileSystem($config)
    {
        if(!isset($config['savePath']))
        {
            throw new \InvalidArgumentException('Missing configuration array argument');
        }
        extract($config);
        $storage = new FileSystem($savePath);
        return new SessionManager($storage);
    }
}