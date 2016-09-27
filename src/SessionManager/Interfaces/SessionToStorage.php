<?php

namespace PhutureProof\SessionManager\Interfaces;

interface SessionToStorage
{
    public function readSessionData($session_id);
    public function checkSessionData($session_id);
    public function deleteSessionData($session_id);
    public function writeSessionData($session_id, $session_data);
    public function close();
}