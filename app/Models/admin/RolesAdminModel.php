<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class RolesAdminModel extends BaseModel{
    protected $table = 'users';

    // lấy toàn bộ dữ liệu 
    public function getAll(){
        $sql = "SELECT * FROM $this->table";
        $this->query($sql);
        return $this->query($sql);
    }
    // lấy dữ liệu theo id
    public function getAllById($id){
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        $this->query($sql);
        return $this->query($sql);
    }
    // thêm dữ liệu
    public function insert($data){
        $sql = "INSERT INTO $this->table (name, description) VALUES (:name, :description)";
        $this->query($sql);
        return $this->execute($sql, $data);
    }

}