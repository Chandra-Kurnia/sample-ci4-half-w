<?php

namespace App\Controllers;

use App\Models\Users;

class Manage extends BaseController
{
    public function manageUser()
    {
        $userModel = new Users();
        $data = [
            'allUser' => $userModel->join('roles', 'roles.role_id = users.role_id', 'left')->where('user_id !=', session()->get('user_id'))->findAll()
        ];
        return view('manage/manageUser', $data);
    }

    public function addUser()
    {
        $rules = [
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[5]|max_length[10]',
            'role' => 'required|in_list[1, 2]',
            'status' => 'required|in_list[active, notActive]'
        ];

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $role_id = $this->request->getVar('role');
        $status = $this->request->getVar('status');

        $userModel = new Users();

        if ($this->validate($rules)) {
            $data = [
                'username'  => $username,
                'password'  => password_hash($password, PASSWORD_BCRYPT),
                'role_id'   => $role_id,
                'status'    => $status,
            ];
            $userModel->save($data);

            return redirect()->to('/manageUser');
        } else {
            $data = [
                'allUser' => $userModel->join('roles', 'roles.role_id = users.role_id', 'left')->where('user_id !=', session()->get('user_id'))->findAll(),
                'validation' => $this->validator,
                'dataForm' => [
                    'username'  => $username,
                    'password'  => $password,
                    'role_id'   => $role_id,
                    'status'    => $status
                ]
            ];
            return view('manage/manageUser', $data);
        }
    }

    public function getById($param)
    {
        $userModel = new Users();
        $data = [
            'dataForm' => $userModel->where('user_id', $param)->first(),
            'allUser' => $userModel->join('roles', 'roles.role_id = users.role_id', 'left')->where('user_id !=', session()->get('user_id'))->findAll(),
            'isEdit' => true
        ];
        return view('manage/manageUser', $data);
    }

    public function updateUser($param)
    {
        // dd($param);
        $rules = [
            'username' => 'required|is_unique[users.username]',
            // 'password' => 'required|min_length[5]|max_length[10]',
            'role' => 'required|in_list[1, 2]',
            'status' => 'required|in_list[active, notActive]'
        ];

        $username = $this->request->getVar('username');
        // $password = $this->request->getVar('password');
        $role_id = $this->request->getVar('role');
        $status = $this->request->getVar('status');

        $userModel = new Users();

        if ($this->validate($rules)) {
            $data = [
                'user_id' => $param,
                'username' => $username,
                // 'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'role_id' => $role_id,
                'status' => $status,
            ];

            $userModel->replace($data);
            // $userModel->update($param, $data);

            return redirect()->to('/manageUser');
        } else {
            $data = [
                'allUser' => $userModel->join('roles', 'roles.role_id = users.role_id', 'left')->where('user_id !=', session()->get('user_id'))->findAll(),
                'validation' => $this->validator,
                'dataForm' => [
                    'username'  => $username,
                    'role_id'   => $role_id,
                    'status'    => $status
                ]
            ];
            return view('manage/manageUser', $data);
        }
    }

    public function deleteUser($param)
    {
        $userModel =  new Users();
        $userModel->where('user_id', $param)->delete();
        return redirect()->to('/manageUser');
    }

    public function manageEmployees()
    {
        return view('manage/manageEmployees');
    }

    public function manageProfile()
    {
        return view('manage/manageProfile');
    }
}
