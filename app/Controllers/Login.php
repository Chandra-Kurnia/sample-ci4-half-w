<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function save()
    {
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        if ($email == 'candra' && $password == 'password') {
            $ses_data = [
                'email' => $email
            ];
            $session->set($ses_data);
            return redirect()->to('/');
        } else {
            $session->setFlashdata('msg', 'username dan password anda salah');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
