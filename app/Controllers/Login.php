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

        if($email === 'candra' && $password === 'password'){
            $ses_data = [
                'email' => $email
            ];
            $session->set($ses_data);
            return redirect()->to('/');
        }else{
            return redirect()->to('/login');
        }
    }
}
