<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class RolesAdminModel extends BaseModel{
    protected $table = 'rooms';

    // lấy toàn bộ dữ liệu 
    public function getAllRoom(){
        $sql = "SELECT * FROM $this->table";
        $this->query($sql);
        return $this->query($sql);
    }
    // lấy dữ liệu theo id
    public function getAllRoomById($id){
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        $this->query($sql);
        return $this->query($sql);
    }
    // thêm dữ liệu
    public function insertRoom($data){
        $sql = "INSERT INTO $this->table id,code,room_child_id,status) VALUES (:id, :code,:room_child_id,:status)";
        $this->query($sql);
        return $this->execute($sql, $data);
    }
    // sửa phong theo id
    public function editRoom($data){
        $sql = "UPDATE $this->table SET code = :code, room_child_id = :room_child_id, status = :status WHERE id = :id";
        $this->query($sql);
        return $this->execute($sql, $data);
    }
    // xóa phong theo id
    public function deleteRoom($id){
        $sql = "DELETE FROM $this->table WHERE id = $id";
        $this->query($sql);
        return $this->execute($sql);
    }
    //đếm số bản ghi
    public function countRoom(){
        $sql = "SELECT * FROM $this->table";
        $this->query($sql);
        return $this->query($sql);
    }
    


}