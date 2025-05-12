<?php

namespace App\Filters;

use App\Models\Users;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $userSession = session()->get('user');
        if (!$userSession) {
            return;
        }

        // Tambahkan pengecekan tipe
        if (!is_array($userSession)) {
            $userSession = json_decode($userSession, true);
        }

        $userModel = new Users();
        $userDatabase = $userModel->find($userSession['id_user']);
        $userCheckDatabase = $userModel->where('nama', $userSession['nama'])->where('email', $userSession['email'])->where('role', $userSession['role'])->first();

        if (!$userDatabase) {
            session()->remove('user');
            session()->destroy();
            return redirect()->to(base_url('/login'))->with('error', 'Sesi kedaluwarsa!');
        }
        if (!$userCheckDatabase) {
            $userData = [
                'id_user' => $userDatabase['id_user'],
                'nama' => $userDatabase['nama'],
                'email' => $userDatabase['email'],
                'role' => $userDatabase['role'],
            ];
            session()->set('user', json_encode($userData));
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
