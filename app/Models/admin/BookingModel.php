<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class BookingModel extends BaseModel
{
    protected $table = 'bookings';

    // lấy toàn bộ dữ liệu từ bảng bookings
    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $this->query($sql);
        return $this->query($sql);
    }
    // lấy dữ liệu theo id
    public function getBookingById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $this->query($sql);
        return $this->execute($sql, ['id' => $id]);
    }
    // thêm mới booking
    public function insertBookings($room_id, $user_id, $time_created, $time_start, $time_end, $status, $note, $getLastId = false)
    {
        $data = [
            'room_id' => $room_id,
            'user_id' => $user_id,
            'time-created' => $time_created,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'status' => $status,
            'note' => $note,
        ];
        return $this->create($this->table, $data, $getLastId);
    }
    // cập nhật dữ liệu booking theo id
    public function updateBookings($room_id, $user_id, $time_created, $time_start, $time_end, $status, $note, $id)
    {
        $data = [
            'room_id' => $room_id,
            'user_id' => $user_id,
            'time-created' => $time_created,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'status' => $status,
            'note' => $note,
        ];
        return $this->update($this->table, $id, $data);
    }
    // delete booking
    public function deleteBookings($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $this->query($sql);
        return $this->execute($sql, ['id' => $id]);
    }
    // đếm số bản ghi
    public function countBookings()
    {
        $sql = "SELECT COUNT(*) as count FROM $this->table";
        $this->query($sql);
        $result = $this->query($sql);
        return $result[0]['count'];
    }
}

