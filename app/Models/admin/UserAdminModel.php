<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class UserAdminModel extends BaseModel{
    protected $table = 'users';

    //lấy toàn bộ dữ liệu
    public function getUsers()
    {
        $sql = "SELECT * FROM $this->table";
        $this->query($sql);
        return $this->query($sql);

    }

    //lấy dữ liệu theo id
    public function getUserById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        $this->query($sql);
        return $this->query($sql);
    }
  
    //thêm dữ liệu
    public function addUser($data)
    {
        $sql = "INSERT INTO $this->table (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $this->query($sql);
        return $this->execute($sql, $data);
    }
  
    //sửa dữ liệu
    public function editUser($data)
    {
        $sql = "UPDATE $this->table SET name = :name, email = :email, password = :password, role = :role WHERE id = :id";
        $this->query($sql);
        return $this->execute($sql, $data);
    }

    //xóa dữ liệu
    public function deleteUser($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = $id";
        $this->query($sql);
        return $this->execute($sql);
    }
  
    //đếm số bản ghi
    public function countUsers()
    {
        $sql = "SELECT * FROM $this->table";
        $this->query($sql);
        return $this->query($sql);
    }
 
    public function updateUser($id, $data)
    {
        $sql = "UPDATE $this->table SET name = :name, email = :email, password = :password, role = :role WHERE id = :id";
        $this->query($sql);
        return $this->execute($sql, $data);
    }
}
