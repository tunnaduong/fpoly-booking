<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class RolesAdminModel extends BaseModel
{
    protected $table = 'rooms';
    protected $colName = [
        'id' => 'id',
        'code' => 'code',
        'room_child_id' => 'room_child_id',
        'status' => 'status'
    ];

    // lấy toàn bộ dữ liệu 
    public function getAllRoom()
    {
        $sql = "SELECT * FROM $this->table";
        $this->query($sql);
        return $this->query($sql);
    }

    // lấy dữ liệu theo id
    public function getAllRoomById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $this->query($sql);
        return $this->execute($sql, ['id' => $id]);
    }

    // thêm dữ liệu
    public function insertRoom($data)
    {
        $columns = [];
        $placeholders = [];
        $values = [];

        foreach ($data as $column => $value) {
            $columns[] = $column;
            $placeholders[] = ":$column";
            $values[":$column"] = $value;
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", $placeholders);

        $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
        $this->query($sql);
        return $this->execute($sql, $values);
    }

    // sửa phòng theo id
    public function editRoom($data)
    {
        $setClause = [];
        foreach ($data as $column => $value) {
            if ($column != 'id') {
                $setClause[] = "$column = :$column";
            }
        }
        $setClause = implode(", ", $setClause);

        $sql = "UPDATE $this->table SET $setClause WHERE id = :id";
        $this->query($sql);
        return $this->execute($sql, $data);
    }

    // xóa phòng theo id
    public function deleteRoom($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $this->query($sql);
        return $this->execute($sql, ['id' => $id]);
    }

    // đếm số bản ghi
    public function countRoom()
    {
        $sql = "SELECT COUNT(*) as count FROM $this->table";
        $this->query($sql);
        $result = $this->query($sql);
        return $result[0]['count'];
    }
}
