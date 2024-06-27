<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class UserModel extends BaseModel
{
    protected $table = 'users';

    //lấy toàn bộ dữ liệu
    public function getUsers()
    {
        $sql = "SELECT u.id, u.name as user_name, u.code, u.email, u.phone, r.name as role_name
                FROM users u
                JOIN roles r ON r.id = u.role_id
                ORDER BY u.id desc";

        return $this->query($sql);        
        // return $this->findAll($this->table);
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
        $result = $this->delete($this->table, $id);
        if($result){
            return true;
        }else{
            dd($this->getErrors());
        }
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
