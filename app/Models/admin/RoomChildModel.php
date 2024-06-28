<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class RoomChildModel extends BaseModel
{
    protected $table = 'rooms_child';
    protected $colName = [
        'id' => 'ID',
        'type' => 'Type',
    ];
    // lấy toàn bộ dữ liệu 
    public function getAllRoomChild()
    {
        $sql = "SELECT * FROM $this->table";
        return $this->query($sql);
    }
    // lấy toàn bộ dữ liệu theo id
    public function getRoomChildById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        return $this->execute($sql, ['id' => $id]);
    }
    // thêm mới room child
    public function insertRoomChild($type, $getLastId = false)
    {
        $data = [
            'type' => $type,
        ];
        return $this->create($this->table, $data, $getLastId);
    }
    // cập nhật room child theo id
    public function updateRoomChild($id, $type)
    {
        $data = [
            'type' => $type,
        ];
        return $this->update($this->table, $id, $data);
    }
    // xóa room child theo id
    public function deleteRoomChild($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        return $this->execute($sql, ['id' => $id]);
    }
    // đếm số bản ghi
    public function countRoomChild()
    {
        $sql = "SELECT COUNT(*) as count FROM $this->table";
        $result = $this->query($sql);
        return $result[0]['count'];
    }
}