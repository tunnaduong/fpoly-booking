<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class UserAdminModel extends BaseModel
{
    protected $table = 'users';

    //lấy toàn bộ dữ liệu
    public function getProduct()
    {
        $sql = "SELECT * FROM $this->table";
        $this->query($sql);
        return $this->query($sql);

    }
}
