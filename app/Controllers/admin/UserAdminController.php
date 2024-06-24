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
                    if ($user['role_id'] == 1) {
                        $this->render('admin.dashboard');
                    }
                    if ($user['role_id'] == 2) {
                        $this->render('manage.dashboard');
                    }
                    if ($user['role_id'] == 3) {
                        $this->render('user.dashboard');
                    }

                    // $this->setAuth($user);
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

    public function createRoom()
    {
        return $this->render('admin.createRoom');
    }

    public function deleteRoom()
    {
        $roomID = $this->getInput('roomID');
        // $this->userAdminModel->removeRoom($roomID);
    }

    public function editRoom()
    {
        return $this->render('admin.editRoom');
    }
}
