<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class RolesModel extends BaseModel{
    protected $table = 'roles';
    protected $colName = [
        'id' => 'ID',
        'name' => 'Role Name',
    ];
    // lấy toàn bộ dữ liệu
    public function getAllRoles(){
        $sql = "SELECT * FROM $this->table";
        return $this->query($sql); 
    }
    // lấy toàn bộ dữ liệu theo id 
    public function getRoleById($id){
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        return $this->execute($sql, ['id' => $id]);
    }
    // thêm mới Roles
    public function insertRole($name,$getLastId = false){
        $data = [
            'name' => $name,
        ];
        return $this->create($this->table,$data,$getLastId);
    }
    // cập nhật theo roles theo id 
    public function updateRole($id,$name){
        $data = [
            'name' => $name,
        ];
        return $this->update($this->table,$id,$data);
    }
    // xóa roles theo id
    public function deleteRole($id){
        $sql = "DELETE FROM $this->table WHERE id = :id";
        return $this->execute($sql, ['id' => $id]);
    }
    // đếm số bản ghi
    public function countRoles(){
        $sql = "SELECT COUNT(*) as count FROM $this->table";
        $result = $this->query($sql);
        return $result[0]['count'];
    }
    
}