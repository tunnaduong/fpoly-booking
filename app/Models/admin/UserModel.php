<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class UserModel extends BaseModel
{
    protected $table = 'users';

    //lấy toàn bộ dữ liệu
    public function getUsers()
    {
        return $this->findAll($this->table);
    }

    //lấy dữ liệu theo id
    public function getUserById($id)
    {
        return $this->find($this->table, $id);
    }

    //thêm dữ liệu
    public function addUser($name, $code, $email, $password, $phone, $role_id, $image)
    {
        $data = [
            'name' => $name,
            'code' => $code,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'role_id' => $role_id,
            'image' => $image,

        ];
        return $this->create($this->table, $data, $getLastId = false);
    }

    //sửa dữ liệu
    public function editUser($name, $code, $email, $password, $phone, $role_id, $image, $id)
    {
        $data = [
            'name' => $name,
            'code' => $code,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'role_id' => $role_id,
            'image' => $image,

        ];
        return $this->update($this->table, $id, $data);
    }

    //xóa dữ liệu
    public function deleteUser($id)
    {
        return $this->delete($this->table, $id);
    }

    //đếm số bản ghi
    public function countUser()
    {
        return $this->count($this->table);
    }

    public function show($id)
    {
        return $this->read($this->table, $id);
    }
}
