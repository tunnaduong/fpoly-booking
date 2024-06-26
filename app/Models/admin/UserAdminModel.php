<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class UserAdminModel extends BaseModel
{
    protected $table = 'users';
    protected $data = [
        'user_name' => $user_name,
        'user_code' => $user_code,
        'user_email' => $user_email,
        'user_password' => $user_password,
        'user_phone' => $user_phone,
        'role_id' => $role_id,
        'user_image' => $user_image,

    ];

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
    public function addUser($data)
    {

        return $this->create($this->table, $data, $getLastId = false);
    }
  
    //sửa dữ liệu
    public function editUser($data)
    {
        return $this->update($this->table, $id, $data);
    }

    //xóa dữ liệu
    public function deleteUser($id)
    {
        return $this->delete($this->table, $id);
    }
  
    //đếm số bản ghi
    public function countProduct()
    {
        return $this->count($this->table);

    }
 
    public function updateUser($id, $data)
    {
        return $this->read($this->table, $id);
    }
}
