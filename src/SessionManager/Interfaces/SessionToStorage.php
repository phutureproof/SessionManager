<?php

namespace PhutureProof\SessionManager\Interfaces;

interface SessionToStorage
{
    public function checkSessionData($session_id);

    public function readSessionData($session_id);

    public function writeSessionData($session_id, $session_data);

    public function deleteSessionData($session_id);

    public function close();

    public function garbageCollection($maxLifetime);
}