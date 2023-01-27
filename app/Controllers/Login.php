<?php

namespace App\Controllers;

use App\Models\Users;

class Login extends BaseController
{
    public function index()
    {
        helper(['form']);
        $data = [];
        return view('auth/login', $data);
    }

    public function save()
    {

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        helper(['form']);
        $rules = [
            'username'      => 'required',
            'password'      => 'required',
        ];
        
        $session = session();
        if ($this->validate($rules)) {
            $userModel = new Users();
            $data = $userModel->where('username', $username)->join('roles', 'roles.role_id = users.role_id', 'left')->first();

            if ($data) {
                $pass_enc = $data['password'];
                $authenticatePassword = password_verify($password, $pass_enc);
                // echo '<pre>' , var_dump($data) , '</pre>';
                // die;
                if ($authenticatePassword) {
                    $ses_data = [
                        'username' => $data['username'],
                        'status' => $data['status'],
                        'is_update' => $data['is_update'],
                        'image' => $data['image'],
                        'role_name' => $data['role_name'],
                        'IS_LOGIN' => true
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/');
                } else {
                    $session->setFlashdata('err-login', 'Your password is incorrect');
                    return redirect()->to('/login');
                }
            } else {
                $session->setFlashdata('err-login', 'Username Not Found');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('err-login', 'required');
            $data['validation'] = $this->validator;
            return view('auth/login', $data);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
