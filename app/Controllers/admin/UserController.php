<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Admin\UserModel;

use Exception;

class UserController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        try {
            if ($this->isPost()) {

                $email = $_POST['email'];
                $password = $_POST['pass'];

                $user = $this->userModel->findByColumn('users', 'email', $email);

                if ($user && $user['password'] == $password) {
                    set_session('user', $user);
                    header('Location: ' . BASE_URL);
                } else {
                    $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
                    $this->render('login', compact("error"));
                }
            } else {
                echo 'không có data gửi lên';
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // tạo user
    public function createUser()
    {
        return $this->render('admin.user.create');
    }

    // lưu user
    public function storeUser()
    {
        $data = $_POST;
        $this->userModel->addUser($data['name'], $data['code'], $data['email'], $data['password'], $data['phone'], $data['role_id'], $data['image']);
        header('Location: ' . BASE_URL . 'admin/user');
    }

    // xóa user
    public function deleteUser()
    {
        $userID = $this->getInput('userID');
        return $this->userModel->deleteUser($userID);
    }

    // sửa user
    public function editUser()
    {
        $userID = $this->getInput('userID');
        $user = $this->userModel->getUserById($userID);
        return $this->render('admin.user.edit', compact('user'));
    }

    // cập nhật user
    public function updateUser()
    {
        $data = $_POST;
        $this->userModel->editUser($data['name'], $data['code'], $data['email'], $data['password'], $data['phone'], $data['role_id'], $data['image'], $data['id']);
        header('Location: ' . BASE_URL . 'admin/user');
    }
}
