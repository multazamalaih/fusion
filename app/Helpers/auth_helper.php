<?php

use App\Models\Users;

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

/**
 * Untuk mengecek apakah data user profile ada di database atau ga.
 */
function checkUserProfile()
{
    $user = getUser();
    if (!$user) {
        session()->remove('user');
        session()->destroy();
        return redirect()->to(base_url('/login'));
    }
    $userModel = new Users();
    $userDatabase = $userModel->where('email', $user['email'])->where('nama', $user['nama'])->first();
    if (!$userDatabase) {
        session()->remove('user');
        session()->destroy();
        return redirect()->to(base_url('/login'));
    }
}
