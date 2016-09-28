<?php

namespace PhutureProof;

use PhutureProof\SessionManager\Interfaces\SessionToStorage;

class SessionManager implements \SessionHandlerInterface
{
    /**
     * @var SessionToStorage
     */
    private $_storage;

    /**
     * SessionManager constructor.
     *
     * @param SessionToStorage $storage
     */
    public function __construct(SessionToStorage $storage)
    {
        $this->_storage = $storage;
    }

    /**
     * @return mixed
     */
    public function close()
    {
        return $this->_storage->close();
    }


    /**
     * @param string $session_id
     *
     * @return mixed
     */
    public function destroy($session_id)
    {
        return $this->_storage->deleteSessionData($session_id);
    }

    /**
     * @param int $maxlifetime
     *
     * @return bool
     */
    public function gc($maxlifetime)
    {
        return $this->_storage->garbageCollection($maxlifetime);
    }

    /**
     * @param string $savePath
     * @param string $sessionName
     *
     * @return bool
     */
    public function open($savePath, $sessionName)
    {
        return true;
    }

    /**
     * @param string $session_id
     *
     * @return mixed
     */
    public function read($session_id)
    {
        return $this->_storage->readSessionData($session_id);
    }

    /**
     * @param string $session_id
     * @param string $session_data
     *
     * @return mixed
     */
    public function write($session_id, $session_data)
    {
        return $this->_storage->writeSessionData($session_id, $session_data);
    }
}