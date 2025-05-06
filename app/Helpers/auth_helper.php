<?php

/**
 * Untuk mendapatkan informasi user.
 */
function getUser()
{
    $userSession = session()->get('user');
    if (!$userSession) {
        return null;
    }
    $userSession = json_decode($userSession, true);
    return $userSession;
}
