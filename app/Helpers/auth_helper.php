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

    // Tambahkan pengecekan apakah sudah array
    if (!is_array($userSession)) {
        $userSession = json_decode($userSession, true);
    }

    return $userSession;
}
/**
 * Untuk mengetahui apakah user sudah login atau belum.
 */
function checkLogin()
{
    $user = getUser();
    if (!$user) {
        return false;
    }
    return true;
}
