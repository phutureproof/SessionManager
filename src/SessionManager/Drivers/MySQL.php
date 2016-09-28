<?php

namespace PhutureProof\SessionManager\Drivers;

use PhutureProof\SessionManager\Interfaces\SessionToStorage;

class MySQL implements SessionToStorage
{
    /**
     * @var \PDO
     */
    private $_database;

    /**
     * MySQL constructor.
     *
     * @param \PDO $database
     */
    public function __construct(\PDO $database)
    {
        $this->_database = $database;
    }

    /**
     * @return bool
     */
    public function close()
    {
        unset($this->_database);

        return true;
    }

    public function garbageCollection($maxLifetime)
    {
        return true;
    }


    /**
     * @param $session_id
     *
     * @return bool|mixed
     */
    public function readSessionData($session_id)
    {
        $fetchSession = $this->_database->prepare("SELECT * FROM sessions WHERE session_id = ?");
        if ($fetchSession->execute([$session_id])) {
            $result = $fetchSession->fetch();

            return $result;
        }

        return false;
    }

    /**
     * @param $session_id
     * @param $session_data
     *
     * @return bool
     */
    public function writeSessionData($session_id, $session_data)
    {
        $writeSession = $this->_database->prepare("REPLACE INTO sessions (session_id, session_data) VALUES (?, ?)");
        if ($writeSession->execute([$session_id, $session_data])) {
            return true;
        }

        return false;
    }

    /**
     * @param $session_id
     *
     * @return bool
     */
    public function deleteSessionData($session_id)
    {
        $destroySession = $this->_database->prepare("DELETE FROM sessions WHERE session_id = ?");
        if ($destroySession->execute([$session_id])) {
            return true;
        }

        return false;
    }

    /**
     * @param $session_id
     *
     * @return bool
     */
    public function checkSessionData($session_id)
    {
        $checkSession = $this->_database->prepare("SELECT * FROM sessions WHERE session_id = ?");
        if ($checkSession->execute([$session_id])) {
            if (count($checkSession->fetchAll())) {
                return true;
            }
        }

        return false;
    }
}
