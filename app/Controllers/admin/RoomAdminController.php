<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Admin\RoomAdminModel;

class RoomAdminController extends BaseController
{
    protected $roomAdminModel;

    public function __construct()
    {
        $this->roomAdminModel = new RoomAdminModel();
    }

    public function index()
    {
        $rooms = $this->roomAdminModel->getAllRoom();
        return $this->render('admin.room.index', compact('rooms'));
    }

    public function create()
    {
        return $this->render('admin.room.create');
    }

    public function store()
    {
        $data = $_POST;
        $this->roomAdminModel->insertRoom($data['code'], $data['room_child_id'], $data['status']);
        header('Location: ' . BASE_URL . 'admin/room');
    }

    public function edit()
    {
        $id = $_GET['id'];
        $room = $this->roomAdminModel->getRoomById($id);
        return $this->render('admin.room.edit', compact('room'));
    }

    public function update()
    {
        $data = $_POST;
        $this->roomAdminModel->editRoom($_POST['roomID'], $data);
        header('Location: ' . BASE_URL . 'admin/room');
    }

    public function delete()
    {
        $id = $_GET['roomID'];
        $this->roomAdminModel->deleteRoom($id);
        header('Location: ' . BASE_URL . 'admin/room');
    }
}
