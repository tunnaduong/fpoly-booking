<?php

namespace App\Models;

use PDO;
use PDOException;

class BaseModel
{
    protected $pdo;
    protected $errors = [];

    /**
     * Khởi tạo kết nối tới cơ sở dữ liệu.
     *
     * @param string $host Tên máy chủ cơ sở dữ liệu.
     * @param string $dbname Tên cơ sở dữ liệu.
     * @param string $username Tên đăng nhập cơ sở dữ liệu.
     * @param string $password Mật khẩu cơ sở dữ liệu.
     */
    public function __construct($host = DB_HOST, $dbname = DB_NAME, $username = DB_USERNAME, $password = DB_PASSWORD)
    {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    /**
     * Thực thi một truy vấn SQL với các tham số.
     *
     * @param string $sql Câu truy vấn SQL.
     * @param array $params Các tham số truy vấn.
     * @param bool $getAll Lấy tất cả kết quả hay chỉ một kết quả.
     * @return array|false Kết quả truy vấn hoặc false nếu có lỗi.
     */
    public function query($sql, $params = [], $getAll = true)
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $getAll ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Tạo một bản ghi mới trong bảng.
     *
     * @param string $table Tên bảng.
     * @param array $data Dữ liệu bản ghi.
     * @param bool $getLastId Trả về ID cuối cùng nếu thành công.
     * @return mixed ID của bản ghi mới hoặc true nếu thành công, false nếu có lỗi.
     */
    public function create($table, $data, $getLastId = false)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            return $getLastId ? $this->pdo->lastInsertId() : true;
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Đọc một bản ghi từ bảng theo ID.
     *
     * @param string $table Tên bảng.
     * @param int $id ID của bản ghi.
     * @return array|false Bản ghi hoặc false nếu có lỗi.
     */
    public function read($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Cập nhật một bản ghi trong bảng theo ID.
     *
     * @param string $table Tên bảng.
     * @param int $id ID của bản ghi.
     * @param array $data Dữ liệu cập nhật.
     * @return bool Trả về true nếu thành công, false nếu có lỗi.
     */
    public function update($table, $id, $data)
    {
        $updates = implode(", ", array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($data)));
        $data['id'] = $id;
        $sql = "UPDATE $table SET $updates WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Cập nhật các bản ghi trong bảng dựa trên một điều kiện riêng.
     *
     * @param string $table Tên bảng.
     * @param array $conditions Điều kiện để xác định bản ghi cần cập nhật.
     * @param array $data Dữ liệu mới để cập nhật.
     * @return bool True nếu cập nhật thành công, False nếu thất bại.
     */
    public function updateByCondition($table, $conditions, $data)
    {
        // Tạo chuỗi điều kiện WHERE
        $whereClause = implode(" AND ", array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($conditions)));

        // Tạo chuỗi cập nhật SET
        $setClause = implode(", ", array_map(function ($key) {
            return "$key = :set_$key";
        }, array_keys($data)));

        // Kết hợp điều kiện và dữ liệu để tạo câu lệnh SQL
        $sql = "UPDATE $table SET $setClause WHERE $whereClause";

        // Kết hợp điều kiện và dữ liệu thành một mảng duy nhất để binding giá trị
        $params = array_merge(
            array_combine(array_map(function ($key) {
                return "set_$key";
            }, array_keys($data)), array_values($data)),
            $conditions
        );

        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }


    /**
     * Xóa một bản ghi trong bảng theo ID.
     *
     * @param string $table Tên bảng.
     * @param int $id ID của bản ghi.
     * @return bool Trả về true nếu thành công, false nếu có lỗi.
     */
    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Xóa các bản ghi trong bảng theo một cột cụ thể.
     *
     * @param string $table Tên bảng.
     * @param string $column Tên cột.
     * @param mixed $value Giá trị của cột.
     * @return bool Trả về true nếu thành công, false nếu có lỗi.
     */
    public function deleteByColumn($table, $column, $value)
    {
        $sql = "DELETE FROM $table WHERE $column = :value";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['value' => $value]);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Tìm một bản ghi từ bảng theo ID.
     *
     * @param string $table Tên bảng.
     * @param int $id ID của bản ghi.
     * @return array|false Bản ghi hoặc false nếu có lỗi.
     */
    public function find($table, $id)
    {
        return $this->read($table, $id);
    }

    /**
     * Tìm tất cả các bản ghi trong bảng.
     *
     * @param string $table Tên bảng.
     * @return array|false Danh sách các bản ghi hoặc false nếu có lỗi.
     */
    public function findAll($table)
    {
        $sql = "SELECT * FROM $table";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Tìm các bản ghi từ bảng với các điều kiện cụ thể.
     *
     * @param string $table Tên bảng.
     * @param array $conditions Các điều kiện truy vấn.
     * @return array|false Danh sách các bản ghi hoặc false nếu có lỗi.
     */
    public function where($table, $conditions)
    {
        $whereClause = implode(" AND ", array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($conditions)));
        $sql = "SELECT * FROM $table WHERE $whereClause";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }


    /**
     * Bắt đầu một giao dịch.
     */
    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    /**
     * Xác nhận các thay đổi trong giao dịch.
     */
    public function commit()
    {
        $this->pdo->commit();
    }

    /**
     * Hoàn tác các thay đổi trong giao dịch.
     */
    public function rollback()
    {
        $this->pdo->rollBack();
    }

    /**
     * Thực thi một câu lệnh SQL không trả về dữ liệu.
     *
     * @param string $sql Câu lệnh SQL.
     * @param array $params Các tham số cho câu lệnh SQL.
     * @return bool True nếu thành công, False nếu thất bại.
     */
    public function execute($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Chèn nhiều bản ghi vào một bảng.
     *
     * @param string $table Tên bảng.
     * @param array $data Danh sách các bản ghi.
     * @return bool True nếu thành công, False nếu thất bại.
     */
    public function bulkInsert($table, $data)
    {
        if (empty($data)) {
            return false;
        }

        $columns = implode(", ", array_keys($data[0]));
        $placeholders = "(" . implode(", ", array_fill(0, count($data[0]), '?')) . ")";
        $values = [];
        foreach ($data as $row) {
            $values = array_merge($values, array_values($row));
        }
        $sql = "INSERT INTO $table ($columns) VALUES " . implode(", ", array_fill(0, count($data), $placeholders));

        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($values);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Thực hiện INNER JOIN giữa các bảng.
     *
     * @param string $table1 Bảng đầu tiên.
     * @param string $table2 Bảng thứ hai.
     * @param string $joinCondition Điều kiện JOIN.
     * @param array $fields Các trường cần lấy.
     * @param array $conditions Điều kiện WHERE.
     * @return array|false Kết quả JOIN hoặc False nếu có lỗi.
     */
    public function innerJoin($table1, $table2, $joinCondition, $fields = ['*'], $conditions = [])
    {
        return $this->joinTables($table1, $table2, $joinCondition, $fields, $conditions, "INNER");
    }

    /**
     * Thực hiện LEFT JOIN giữa các bảng.
     *
     * @param string $table1 Bảng đầu tiên.
     * @param string $table2 Bảng thứ hai.
     * @param string $joinCondition Điều kiện JOIN.
     * @param array $fields Các trường cần lấy.
     * @param array $conditions Điều kiện WHERE.
     * @return array|false Kết quả JOIN hoặc False nếu có lỗi.
     */
    public function leftJoin($table1, $table2, $joinCondition, $fields = ['*'], $conditions = [])
    {
        return $this->joinTables($table1, $table2, $joinCondition, $fields, $conditions, "LEFT");
    }

    /**
     * Thực hiện RIGHT JOIN giữa các bảng.
     *
     * @param string $table1 Bảng đầu tiên.
     * @param string $table2 Bảng thứ hai.
     * @param string $joinCondition Điều kiện JOIN.
     * @param array $fields Các trường cần lấy.
     * @param array $conditions Điều kiện WHERE.
     * @return array|false Kết quả JOIN hoặc False nếu có lỗi.
     */
    public function rightJoin($table1, $table2, $joinCondition, $fields = ['*'], $conditions = [])
    {
        return $this->joinTables($table1, $table2, $joinCondition, $fields, $conditions, "RIGHT");
    }

    /**
     * Thực thi một truy vấn join giữa nhiều bảng.
     *
     * @param string $table1 Tên bảng đầu tiên.
     * @param string $table2 Tên bảng thứ hai.
     * @param string $joinCondition Điều kiện join giữa hai bảng.
     * @param array $fields Các trường cần lấy dữ liệu.
     * @param array $conditions Các điều kiện truy vấn.
     * @param string $joinType Loại JOIN (INNER, LEFT, RIGHT).
     * @return array|false Danh sách các bản ghi hoặc false nếu có lỗi.
     */
    public function joinTables($table1, $table2, $joinCondition, $fields = ['*'], $conditions = [], $joinType = "INNER")
    {
        $fieldsList = implode(", ", $fields);
        $sql = "SELECT $fieldsList FROM $table1 $joinType JOIN $table2 ON $joinCondition";

        if (!empty($conditions)) {
            $whereClause = implode(" AND ", array_map(function ($key) {
                return "$key = :$key";
            }, array_keys($conditions)));
            $sql .= " WHERE $whereClause";
        }

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Sắp xếp các bản ghi trong bảng theo một trường cụ thể.
     *
     * @param string $table Tên bảng.
     * @param string $field Tên trường.
     * @param string $direction Hướng sắp xếp (ASC hoặc DESC).
     * @return array|false Danh sách các bản ghi hoặc false nếu có lỗi.
     */
    public function orderBy($table, $field, $direction = 'ASC')
    {
        $sql = "SELECT * FROM $table ORDER BY $field $direction";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Giới hạn số lượng các bản ghi trả về từ bảng.
     *
     * @param string $table Tên bảng.
     * @param int $limit Số lượng bản ghi giới hạn.
     * @param int $offset Vị trí bắt đầu lấy bản ghi.
     * @return array|false Danh sách các bản ghi hoặc false nếu có lỗi.
     */
    public function limit($table, $limit, $offset = 0)
    {
        $sql = "SELECT * FROM $table LIMIT :offset, :limit";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Lưu bản ghi vào bảng (tạo mới hoặc cập nhật nếu đã tồn tại).
     *
     * @param string $table Tên bảng.
     * @param array $data Dữ liệu bản ghi.
     * @return bool Trả về true nếu thành công, false nếu có lỗi.
     */
    public function save($table, $data)
    {
        if (isset($data['id'])) {
            return $this->update($table, $data['id'], $data);
        } else {
            return $this->create($table, $data);
        }
    }

    /**
     * Lấy danh sách các bảng trong cơ sở dữ liệu.
     *
     * @return array|false Danh sách các bảng hoặc false nếu có lỗi.
     */
    public function getTables()
    {
        $sql = "SHOW TABLES";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Lấy danh sách các cột của một bảng cụ thể.
     *
     * @param string $table Tên bảng.
     * @return array|false Danh sách các cột hoặc false nếu có lỗi.
     */
    public function getColumns($table)
    {
        $sql = "SHOW COLUMNS FROM $table";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Kiểm tra xem một bản ghi có tồn tại trong bảng hay không.
     *
     * @param string $table Tên bảng.
     * @param array $conditions Điều kiện kiểm tra.
     * @return bool True nếu tồn tại, False nếu không tồn tại.
     */
    public function exists($table, $conditions)
    {
        $whereClause = implode(" AND ", array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($conditions)));
        $sql = "SELECT COUNT(*) FROM $table WHERE $whereClause";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Cập nhật bản ghi nếu tồn tại, nếu không thì tạo mới.
     *
     * @param string $table Tên bảng.
     * @param array $conditions Điều kiện kiểm tra.
     * @param array $data Dữ liệu cần cập nhật hoặc tạo mới.
     * @return bool True nếu thành công, False nếu thất bại.
     */
    public function updateOrCreate($table, $conditions, $data)
    {
        if ($this->exists($table, $conditions)) {
            return $this->updateByCondition($table, $conditions, $data);
        } else {
            return $this->create($table, array_merge($conditions, $data));
        }
    }

    /**
     * Lấy giá trị của một cột từ các bản ghi.
     *
     * @param string $table Tên bảng.
     * @param string $column Tên cột.
     * @param array $conditions Điều kiện lọc.
     * @return array|false Danh sách giá trị hoặc false nếu có lỗi.
     */
    public function pluck($table, $column, $conditions = [])
    {
        $whereClause = "";
        if (!empty($conditions)) {
            $whereClause = "WHERE " . implode(" AND ", array_map(function ($key) {
                return "$key = :$key";
            }, array_keys($conditions)));
        }
        $sql = "SELECT $column FROM $table $whereClause";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Lấy bản ghi đầu tiên khớp với điều kiện.
     *
     * @param string $table Tên bảng.
     * @param array $conditions Điều kiện lọc.
     * @return array|false Bản ghi đầu tiên hoặc false nếu có lỗi.
     */
    public function first($table, $conditions = [])
    {
        $whereClause = "";
        if (!empty($conditions)) {
            $whereClause = "WHERE " . implode(" AND ", array_map(function ($key) {
                return "$key = :$key";
            }, array_keys($conditions)));
        }
        $sql = "SELECT * FROM $table $whereClause LIMIT 1";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Lấy bản ghi cuối cùng khớp với điều kiện.
     *
     * @param string $table Tên bảng.
     * @param array $conditions Điều kiện lọc.
     * @return array|false Bản ghi cuối cùng hoặc false nếu có lỗi.
     */
    public function last($table, $conditions = [])
    {
        $whereClause = "";
        if (!empty($conditions)) {
            $whereClause = "WHERE " . implode(" AND ", array_map(function ($key) {
                return "$key = :$key";
            }, array_keys($conditions)));
        }
        $sql = "SELECT * FROM $table $whereClause ORDER BY id DESC LIMIT 1";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }


    /**
     * Kiểm tra tính hợp lệ của dữ liệu dựa trên các quy tắc.
     *
     * @param array $data Dữ liệu cần kiểm tra.
     * @param array $rules Các quy tắc kiểm tra.
     * @return array Danh sách các lỗi nếu có.
     */
    public function validate($data, $rules)
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            if ($rule === 'required' && empty($data[$field])) {
                $errors[] = "$field là bắt buộc";
            }
        }
        return $errors;
    }

    /**
     * Chuyển đối tượng thành mảng.
     *
     * @param object $object Đối tượng cần chuyển đổi.
     * @return array Mảng kết quả.
     */
    public function toArray($object)
    {
        return (array)$object;
    }

    /**
     * Chuyển đối tượng thành chuỗi JSON.
     *
     * @param object $object Đối tượng cần chuyển đổi.
     * @return string Chuỗi JSON kết quả.
     */
    public function toJson($object)
    {
        return json_encode($object);
    }

    /**
     * Lấy danh sách các lỗi xảy ra.
     *
     * @return array Danh sách các lỗi.
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Tìm các bản ghi từ bảng theo một cột cụ thể.
     *
     * @param string $table Tên bảng.
     * @param string $column Tên cột.
     * @param mixed $value Giá trị của cột.
     * @param bool $getAll Lấy tất cả các kết quả hoặc chỉ một kết quả.
     * @return array|false Danh sách các bản ghi hoặc một bản ghi hoặc false nếu có lỗi.
     */
    public function findByColumn($table, $column, $value, $getAll = false)
    {
        $sql = "SELECT * FROM $table WHERE $column = :value";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['value' => $value]);
            return $getAll ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Đếm số lượng bản ghi trong bảng.
     *
     * @param string $table Tên bảng.
     * @return int|false Số lượng bản ghi hoặc false nếu có lỗi.
     */
    public function count($table)
    {
        $sql = "SELECT COUNT(*) as count FROM $table";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Tính tổng của một cột trong bảng.
     *
     * @param string $table Tên bảng.
     * @param string $column Tên cột.
     * @return float|false Tổng của cột hoặc false nếu có lỗi.
     */
    public function sum($table, $column)
    {
        $sql = "SELECT SUM($column) as sum FROM $table";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC)['sum'];
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Tính giá trị trung bình của một cột trong bảng.
     *
     * @param string $table Tên bảng.
     * @param string $column Tên cột.
     * @return float|false Giá trị trung bình của cột hoặc false nếu có lỗi.
     */
    public function avg($table, $column)
    {
        $sql = "SELECT AVG($column) as avg FROM $table";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC)['avg'];
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Tính giá trị lớn nhất của một cột trong bảng.
     *
     * @param string $table Tên bảng.
     * @param string $column Tên cột.
     * @return float|false Giá trị lớn nhất của cột hoặc false nếu có lỗi.
     */
    public function max($table, $column)
    {
        $sql = "SELECT MAX($column) as max FROM $table";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC)['max'];
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Tính giá trị nhỏ nhất của một cột trong bảng.
     *
     * @param string $table Tên bảng.
     * @param string $column Tên cột.
     * @return float|false Giá trị nhỏ nhất của cột hoặc false nếu có lỗi.
     */
    public function min($table, $column)
    {
        $sql = "SELECT MIN($column) as min FROM $table";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC)['min'];
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }
}
