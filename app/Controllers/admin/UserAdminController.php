<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Admin\UserAdminModel;

use Exception;

class UserAdminController extends BaseController
{

    protected $userAdminModel;

    public function __construct()
    {
        $this->userAdminModel = new UserAdminModel();
    }

    public function login()
    {
        try {
            if ($this->isPost()) {

                $email = $_POST['email'];
                $password = $_POST['pass'];

                $user = $this->userAdminModel->findByColumn('users', 'user_email', $email);

                if ($user && $user['user_password'] == $password) {
                    set_session('user', $user);
                    header('Location: ' . BASE_URL);
                } else {
                    // $this->render('login');
                    echo "Đăng nhập thất bại";
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
        $this->userAdminModel->addUser($data);
        header('Location: ' . BASE_URL . 'admin/user');
    }

    // xóa user
    public function deleteUser()
    {
        $userID = $this->getInput('userID');
        return $this->userAdminModel->deleteUser($userID);
    }

    // sửa user
    public function editUser()
    {
        $userID = $this->getInput('userID');
        $user = $this->userAdminModel->getUserById($userID);
        return $this->render('admin.user.edit', compact('user'));
    }

    // cập nhật user
    public function updateUser()
    {
        $data = $_POST;
        $this->userAdminModel->updateUser($data['userID'], $data);
        header('Location: ' . BASE_URL . 'admin/user');
    }
}
