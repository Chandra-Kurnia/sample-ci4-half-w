<?php

namespace App\Controllers;

use App\Models\Users;

class Manage extends BaseController
{
    public function manageUser()
    {
        helper(['form']);
        $userModel = new Users();
        $data = [
            'allUser' => $userModel->join('roles', 'roles.role_id = users.role_id', 'left')->findAll()
        ];
        return view('manage/manageUser', $data);
    }

    public function addUser()
    {
        helper(['form']);
        $rules = [
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[5]|max_length[10]',
            'role' => 'required|in_list[1, 2]',
            'status' => 'required|in_list[active, notActive]'
        ];

        $userModel = new Users();

        if($this->validate($rules)){
            $data = [
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'role_id' => $this->request->getVar('role'),
                'status' => $this->request->getVar('status'),
            ];
            $userModel->save($data);
            
            return redirect()->to('/manageUser');
        }else{
            $data = [
                // 'allUser' => $userModel->join('roles', 'roles.role_id = users.role_id', 'left')->findAll(),
                'validation' => $this->validator
            ];
            return view('manage/manageUser', $data);
            // return redirect()->to('/manageUser');
            // echo "tes";
        }
    }

    public function getById($param)
    {
        $userModel = new Users();
        $data = [
            'userEdit' => $userModel->where('user_id', $param)->first(),
            'allUser' => $userModel->join('roles', 'roles.role_id = users.role_id', 'left')->findAll(),
        ];
        return view('manage/manageUser', $data);
    }

    public function updateUser($param)
    {
        dd($param);
        helper(['form']);
        $rules = [
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[5]|max_length[10]',
            'role' => 'required|in_list[1, 2]',
            'status' => 'required|in_list[active, notActive]'
        ];

        $userModel = new Users();

        if($this->validate($rules)){
            $data = [
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'role_id' => $this->request->getVar('role'),
                'status' => $this->request->getVar('status'),
            ];
            $userModel->save($data);
            
            return redirect()->to('/manageUser');
        }else{
            $data = [
                'allUser' => $userModel->join('roles', 'roles.role_id = users.role_id', 'left')->findAll(),
                'validation' => $this->validator
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
