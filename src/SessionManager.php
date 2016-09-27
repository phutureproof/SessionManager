<?php

namespace PhutureProof;

use PhutureProof\SessionManager\Interfaces\SessionToStorage;

class SessionManager implements \SessionHandlerInterface
{
    private $_storage;

    public function __construct(SessionToStorage $storage)
    {
        $this->_storage = $storage;
    }

    public function close()
    {
        return $this->_storage->close();
    }


    public function destroy($session_id)
    {
        return $this->_storage->deleteSessionData($session_id);
    }

    public function gc($maxlifetime)
    {
        return true;
    }

    public function open($savePath, $sessionName)
    {
        return true;
    }

    public function read($session_id)
    {
        return $this->_storage->readSessionData($session_id);
    }

    public function write($session_id, $session_data)
    {
        return $this->_storage->writeSessionData($session_id, $session_data);
    }
}