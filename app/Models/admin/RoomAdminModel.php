<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class RoomAdminModel extends BaseModel{
    protected $table = 'rooms';

    // lấy toàn bộ dữ liệu 
    public function getAllRoom(){
        $sql = "SELECT * FROM $this->table";
        return $this->query($sql);
    }

    // lấy dữ liệu theo id
    public function getRoomById($id){
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        return $this->execute($sql, ['id' => $id]);
    }

    // thêm dữ liệu
    public function insertRoom($code,$child_id,$status, $getLastId = false){
        $data=[
            'code' => $code,
            'room_child_id' => $child_id,
           'status' => $status,
        ];
        return $this->create($this->table, $data, $getLastId);
    }
    // sửa phòng theo id
    public function editRoom($id,$data){
        return $this->update($this->table, $id, $data);
    }
    // xóa phòng theo id
    public function deleteRoom($id){
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $this->query($sql);
        return $this->execute($sql, ['id' => $id]);
    }
    // đếm số bản ghi
    public function countRooms(){
        $sql = "SELECT COUNT(*) as count FROM $this->table";
        $this->query($sql);
        $result = $this->query($sql);
        return $result[0]['count'];
    }
}
