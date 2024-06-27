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

    public function index()
    {
        $data = $this->userModel->getUsers();



        $header = [
            'id' => '#',
            'user_name' => 'Tên người dùng',
            'code' => 'Code',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'role_name' => 'Quyền'
        ];


        $card = [
            'title' => 'Quản lý người dùng',
            'description' => 'Quản lý',
            'table' => [
                'style' => 'hover',
                'header' => $header,
                'data' => $data
            ],
        ];


        // echo '<pre>';
        // var_export($card);
        // echo '</pre>';

        // die();




        $this->render('pages.admin.manage.user', compact('card'));
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
    public function delUser($id)
    {
 
        $result = $this->userModel->deleteUser($id);
        //thông báo
        if($result){
            $this->setFlash('success', 'User deleted successfully');
            header('Location: '. BASE_URL. 'user/manage');
        }else{
            $this->setFlash('error', 'User not deleted');
            header('Location: '. BASE_URL. 'user/manage');
        }


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
