<?php

namespace PhutureProof\SessionManager\Drivers;

use PhutureProof\SessionManager\Interfaces\SessionToStorage;

class MySQL implements SessionToStorage
{
    public $database;

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function close()
    {
        unset($this->database);
        return true;
    }

    public function readSessionData($session_id)
    {
        $fetchSession = $this->database->prepare("SELECT * FROM sessions WHERE session_id = ?");
        if ($fetchSession->execute([$session_id])) {
            $result = $fetchSession->fetch();

            return $result;
        }

        return false;
    }

    public function writeSessionData($session_id, $session_data)
    {
        $writeSession = $this->database->prepare("REPLACE INTO sessions (session_id, session_data) VALUES (?, ?)");
        if ($writeSession->execute([$session_id, $session_data])) {
            return true;
        }

        return false;
    }

    public function deleteSessionData($session_id)
    {
        $destroySession = $this->database->prepare("DELETE FROM sessions WHERE session_id = ?");
        if ($destroySession->execute([$session_id])) {
            return true;
        }

        return false;
    }

    public function checkSessionData($session_id)
    {
        $checkSession = $this->database->prepare("SELECT * FROM sessions WHERE session_id = ?");
        if ($checkSession->execute([$session_id])) {
            if (count($checkSession->fetchAll())) {
                return true;
            }
        }

        return false;
    }
}
