<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $user = get_session('user');
        if ($user['role_id'] == 1) {
            $this->render('pages.admin.dashboard');
        }
        if ($user['role_id'] == 2) {
            $this->render('pages.admin.manage.dashboard');
        }
        if ($user['role_id'] == 3) {
            $this->render('pages.user.dashboard');
        }
        if ($user == null) {
            header('Location: ' . BASE_URL . 'login');
        }
    }

    public function login()
    {
        $this->render('login');
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . 'login');
    }
}
