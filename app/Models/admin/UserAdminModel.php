<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class UserAdminModel extends BaseModel{
    protected $table = 'users';

    //lấy toàn bộ dữ liệu
    public function getProduct()
    {
        $sql = "SELECT * FROM $this->table";
        $this->query($sql);
        return $this->query($sql);

    }
    //lấy dữ liệu theo id
    public function getProductById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        $this->query($sql);
        return $this->query($sql);
    }
    //thêm dữ liệu
    public function addProduct($data)
    {
        $sql = "INSERT INTO $this->table (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $this->query($sql);
        return $this->execute($sql, $data);
    }
    //sửa dữ liệu
    public function editProduct($data)


    {
        $sql = "UPDATE $this->table SET name = :name, email = :email, password = :password, role = :role WHERE id = :id";
        $this->query($sql);
        return $this->execute($sql, $data);
    }

    //xóa dữ liệu
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = $id";
        $this->query($sql);
        return $this->execute($sql);
    }
    //đếm số bản ghi
    public function countProduct()
    {
        $sql = "SELECT * FROM $this->table";
        $this->query($sql);
        return $this->query($sql);
    }
 
    public function updateProduct($id, $data)
    {
        $sql = "UPDATE $this->table SET name = :name, email = :email, password = :password, role = :role WHERE id = :id";
        $this->query($sql);
        return $this->execute($sql, $data);
    }





    
}