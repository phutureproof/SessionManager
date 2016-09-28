<?php

namespace PhutureProof\SessionManager\Drivers;

use PhutureProof\SessionManager\Interfaces\SessionToStorage;

class FileSystem implements SessionToStorage
{
    /**
     * @var string $_savePath
     */
    private $_savePath;

    /**
     * FileSystem constructor.
     *
     * @param string $savePath
     */
    public function __construct($savePath)
    {
        $this->_savePath = $savePath;
        
        if ( ! is_dir($this->_savePath)) {
            mkdir($this->_savePath, 0777, true);
        }
    }

    /**
     * @param string $session_id
     *
     * @return bool
     */
    public function readSessionData($session_id)
    {
        $file = $this->_savePath . "/{$session_id}.session";
        if ( ! file_exists($file)) {
            return false;
        }
        file_get_contents($file);
        return true;
    }

    /**
     * @param string $session_id
     *
     * @return bool
     */
    public function checkSessionData($session_id)
    {
        $file = $this->_savePath . "/{$session_id}.session";
        if ( ! file_exists($file)) {
            return false;
        }
        return true;
    }

    /**
     * @param string $session_id
     *
     * @return bool
     */
    public function deleteSessionData($session_id)
    {
        $file = $this->_savePath . "/{$session_id}.session";
        if ( ! file_exists($file)) {
            return false;
        }
        unlink($file);
        return true;
    }

    /**
     * @param string $session_id
     * @param string $session_data
     *
     * @return bool
     */
    public function writeSessionData($session_id, $session_data)
    {
        $file = $this->_savePath . "/{$session_id}.session";
        file_put_contents($file, $session_data);
        return true;
    }

    /**
     * @param $maxLifetime
     */
    public function garbageCollection($maxLifetime)
    {
        return true;
    }

    /**
     * @return bool
     */
    public function close()
    {
        return true;
    }

}