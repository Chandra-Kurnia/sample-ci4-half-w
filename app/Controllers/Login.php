<?php

namespace App\Controllers;

use App\Models\Users;

class Login extends BaseController
{
    public function index()
    {
        $data = [];
        return view('auth/login', $data);
    }

    public function save()
    {
        $session = session();
        $session->removeTempdata('err-login');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $rules = [
            'username'      => 'required',
            'password'      => 'required',
        ];

        $data = [
            'dataForm' => [
                'username' => $username,
                'password' => $password
            ]
        ];
        
        if ($this->validate($rules)) {
            $userModel = new Users();
            $user = $userModel->where('username', $username)->join('roles', 'roles.role_id = users.role_id', 'left')->first();

            if ($user) {
                $pass_enc = $user['password'];
                $authenticatePassword = password_verify($password, $pass_enc);
                // echo '<pre>' , var_dump($data) , '</pre>';
                // die;
                if ($authenticatePassword) {
                    $ses_data = [
                        'user_id' => $user['user_id'],
                        'username' => $user['username'],
                        'status' => $user['status'],
                        'is_update' => $user['is_update'],
                        'image' => $user['image'],
                        'role_name' => $user['role_name'],
                        'IS_LOGIN' => true
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/');
                } else {
                    $session->setFlashdata('err-login', 'Your password is incorrect !');
                    return view('auth/login', $data);
                }
            } else {
                $session->setFlashdata('err-login', 'Username not found !');
                return view('auth/login', $data);
            }
        } else {
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
