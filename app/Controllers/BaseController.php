<?php

namespace App\Controllers;

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

use eftec\bladeone\BladeOne;

class BaseController
{

    /**
     * Render một view Blade.
     *
     * @param string $viewFile Tên file view cần render.
     * @param array $data Dữ liệu truyền vào view.
     */
    protected function render($viewFile, $data = [])
    {
        $viewDir = __DIR__ . "/../../src/views";
        $storageDir = __DIR__ . "/../../storage";
        $blade = new BladeOne($viewDir, $storageDir, BladeOne::MODE_DEBUG);
        echo $blade->run($viewFile, $data);
    }

    /**
     * Lấy thông báo lỗi thân thiện cho các lỗi SQL thông thường.
     *
     * @param string $error Thông báo lỗi.
     * @return string Thông báo lỗi thân thiện.
     */
    protected function getFriendlyErrorMessage($error)
    {
        $errorMessages = [
            'Cannot delete or update a parent row: a foreign key constraint fails' => 'Không thể xóa bản ghi này vì nó liên quan đến các bản ghi khác.',
            'Duplicate entry' => 'Bản ghi với thông tin này đã tồn tại.',
            'Data too long for column' => 'Dữ liệu cung cấp quá dài cho một trong các trường.',
            'Incorrect integer value' => 'Giá trị không đúng cho trường kiểu số nguyên.',
            'Cannot add or update a child row: a foreign key constraint fails' => 'Không thể thêm hoặc cập nhật bản ghi này vì nó tham chiếu đến một bản ghi không hợp lệ.',
            // Thêm các ánh xạ lỗi khác nếu cần
        ];

        foreach ($errorMessages as $pattern => $message) {
            if (strpos($error, $pattern) !== false) {
                return $message;
            }
        }

        // Trả về lỗi gốc nếu không khớp với bất kỳ lỗi nào
        return 'Đã xảy ra lỗi: ' . $error;
    }

    /**
     * Xác thực dữ liệu yêu cầu theo các quy tắc.
     *
     * @param array $data Dữ liệu yêu cầu.
     * @param array $rules Các quy tắc xác thực.
     * @return array Một mảng các thông báo lỗi, nếu có.
     */
    protected function validateRequest($data, $rules)
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            if ($rule === 'required' && empty($data[$field])) {
                $errors[] = "$field là bắt buộc";
            }
            // Thêm các quy tắc xác thực khác nếu cần
        }
        return $errors;
    }

    /**
     * Chuyển hướng đến một URL cụ thể.
     *
     * @param string $url URL để chuyển hướng.
     */
    protected function redirect($url)
    {
        header("Location: $url");
        exit();
    }

    /**
     * Gửi phản hồi dưới dạng JSON.
     *
     * @param mixed $data Dữ liệu để gửi trong phản hồi.
     * @param int $status Mã trạng thái HTTP (mặc định là 200).
     */
    protected function jsonResponse($data, $status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit();
    }

    /**
     * Kiểm tra nếu phương thức yêu cầu là POST.
     *
     * @return bool Trả về true nếu là POST, ngược lại false.
     */
    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Kiểm tra nếu phương thức yêu cầu là GET.
     *
     * @return bool Trả về true nếu là GET, ngược lại false.
     */
    protected function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * Kiểm tra nếu phương thức yêu cầu là PUT.
     *
     * @return bool Trả về true nếu là PUT, ngược lại false.
     */
    protected function isPut()
    {
        return $_SERVER['REQUEST_METHOD'] === 'PUT';
    }

    /**
     * Kiểm tra nếu phương thức yêu cầu là DELETE.
     *
     * @return bool Trả về true nếu là DELETE, ngược lại false.
     */
    protected function isDelete()
    {
        return $_SERVER['REQUEST_METHOD'] === 'DELETE';
    }

    /**
     * Lấy giá trị đầu vào từ yêu cầu.
     *
     * @param string $key Khóa của giá trị cần lấy.
     * @param mixed $default Giá trị mặc định nếu khóa không tồn tại.
     * @return mixed Giá trị đầu vào hoặc giá trị mặc định.
     */
    protected function getInput($key, $default = null)
    {
        return $_REQUEST[$key] ?? $default;
    }

    /**
     * Đặt thông báo flash.
     *
     * @param string $key Khóa của thông báo.
     * @param string $message Nội dung thông báo.
     */
    protected function setFlash($key, $message)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['flash'][$key] = $message;
    }

    /**
     * Lấy thông báo flash.
     *
     * @param string $key Khóa của thông báo.
     * @return string|null Nội dung thông báo hoặc null nếu không tồn tại.
     */
    protected function getFlash($key)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['flash'][$key])) {
            $message = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $message;
        }
        return null;
    }

    /**
     * Kiểm tra người dùng hiện tại đã được xác thực chưa.
     *
     * @return mixed Thông tin người dùng nếu đã xác thực, ngược lại null.
     */
    protected function auth()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        return $_SESSION['user'] ?? null;
    }

    /**
     * Đặt thông tin người dùng đã xác thực.
     *
     * @param mixed $user Thông tin người dùng.
     */
    protected function setAuth($user)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['user'] = $user;
    }

    /**
     * Hủy thông tin người dùng đã xác thực.
     */
    protected function destroyAuth()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION['user']);
    }

    /**
     * Loại bỏ các ký tự không hợp lệ khỏi dữ liệu.
     *
     * @param string $data Dữ liệu đầu vào.
     * @return string Dữ liệu đã được làm sạch.
     */
    protected function sanitize($data)
    {
        return htmlspecialchars(strip_tags($data));
    }

    /**
     * Định dạng ngày tháng.
     *
     * @param string $date Ngày tháng cần định dạng.
     * @param string $format Định dạng đầu ra (mặc định là 'Y-m-d H:i:s').
     * @return string Ngày tháng đã được định dạng.
     */
    protected function formatDate($date, $format = 'Y-m-d H:i:s')
    {
        return date($format, strtotime($date));
    }

    /**
     * Tạo mã CSRF.
     *
     * @return string Mã CSRF.
     */
    protected function csrfToken()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Xác thực mã CSRF.
     *
     * @param string $token Mã CSRF cần xác thực.
     * @return bool Trả về true nếu mã hợp lệ, ngược lại false.
     */
    protected function validateCsrfToken($token)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Ghi log thông điệp vào file log.
     *
     * @param string $message Thông điệp log.
     * @param string $file Tên file log.
     */
    protected function logger($message, $file = 'app.log')
    {
        $filePath = __DIR__ . "/../../logs/" . $file;
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] $message" . PHP_EOL;
        file_put_contents($filePath, $logMessage, FILE_APPEND);
    }

    /**
     * Upload file lên server.
     *
     * @param array $file Thông tin file upload.
     * @param string $destinationDir Thư mục đích để lưu file.
     * @return array Kết quả upload (success, path hoặc errors).
     */
    protected function uploadFile($file, $destinationDir)
    {
        $errors = [];
        $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = time() . '.' . $fileType;
        $targetFilePath = rtrim($destinationDir, '/') . '/' . $fileName;

        // Kiểm tra kích thước file
        if ($file['size'] > 5000000) {
            $errors[] = 'File quá lớn.';
        }

        // Kiểm tra loại file
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = 'Loại file không hợp lệ.';
        }

        if (empty($errors)) {
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return ['success' => true, 'path' => $targetFilePath];
            } else {
                $errors[] = 'Lỗi khi upload file.';
            }
        }

        return ['success' => false, 'errors' => $errors];
    }

    /**
     * Chuyển hướng trở lại trang trước đó.
     */
    protected function back()
    {
        $url = $_SERVER['HTTP_REFERER'] ?? '/';
        header("Location: $url");
        exit();
    }

    /**
     * Phân trang dữ liệu.
     *
     * @param array $data Dữ liệu cần phân trang.
     * @param int $page Trang hiện tại.
     * @param int $perPage Số lượng mục trên mỗi trang.
     * @return array Mảng chứa dữ liệu phân trang.
     */
    protected function paginate($data, $page = 1, $perPage = 10)
    {
        $total = count($data);
        $start = ($page - 1) * $perPage;
        $paginatedData = array_slice($data, $start, $perPage);
        return [
            'data' => $paginatedData,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage),
        ];
    }


    /// Một vài hàm khác ít sử dụng (Huỷ Comment để chạy)

    /**
     * Gửi email.
     *
     * @param string $to Địa chỉ email người nhận.
     * @param string $subject Tiêu đề email.
     * @param string $body Nội dung email.
     * @param string $from Địa chỉ email người gửi (mặc định là null).
     * @param string $fromName Tên người gửi (mặc định là null).
     * @return bool Trả về true nếu email được gửi thành công, ngược lại false.
     */
    // protected function sendEmail($to, $subject, $body, $from = null, $fromName = null)
    // {
    //     $mail = new PHPMailer(true);
    //     try {
    //         // Cấu hình SMTP
    //         $mail->isSMTP();
    //         $mail->Host = 'smtp.example.com';
    //         $mail->SMTPAuth = true;
    //         $mail->Username = 'your_email@example.com';
    //         $mail->Password = 'your_email_password';
    //         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //         $mail->Port = 587;

    //         // Người gửi
    //         if ($from) {
    //             $mail->setFrom($from, $fromName);
    //         } else {
    //             $mail->setFrom('no-reply@example.com', 'No Reply');
    //         }

    //         // Người nhận
    //         $mail->addAddress($to);

    //         // Nội dung email
    //         $mail->isHTML(true);
    //         $mail->Subject = $subject;
    //         $mail->Body    = $body;

    //         $mail->send();
    //         return true;
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }

    /**
     * Đọc file JSON.
     *
     * @param string $filePath Đường dẫn đến file JSON.
     * @return array Mảng dữ liệu từ file JSON.
     */
    // protected function readJsonFile($filePath)
    // {
    //     if (file_exists($filePath)) {
    //         $json = file_get_contents($filePath);
    //         return json_decode($json, true);
    //     }
    //     return [];
    // }

    /**
     * Ghi dữ liệu vào file JSON.
     *
     * @param string $filePath Đường dẫn đến file JSON.
     * @param array $data Dữ liệu cần ghi.
     * @return bool Trả về true nếu ghi thành công, ngược lại false.
     */
    // protected function writeJsonFile($filePath, $data)
    // {
    //     $json = json_encode($data, JSON_PRETTY_PRINT);
    //     return file_put_contents($filePath, $json) !== false;
    // }

    /**
     * Gọi API bên ngoài.
     *
     * @param string $url URL của API.
     * @param array $params Tham số truyền vào.
     * @param string $method Phương thức HTTP (GET, POST, PUT, DELETE).
     * @param array $headers Headers của yêu cầu.
     * @return array Kết quả phản hồi từ API.
     */
    // protected function callExternalApi($url, $params = [], $method = 'GET', $headers = [])
    // {
    //     $ch = curl_init();
    //     if ($method === 'GET') {
    //         $url .= '?' . http_build_query($params);
    //     } else {
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    //     }
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge([
    //         'Content-Type: application/json',
    //     ], $headers));

    //     $response = curl_exec($ch);
    //     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //     curl_close($ch);

    //     return [
    //         'status_code' => $httpCode,
    //         'response' => json_decode($response, true),
    //     ];
    // }

    /**
     * Tạo slug từ chuỗi.
     *
     * @param string $string Chuỗi gốc.
     * @return string Slug được tạo ra.
     */
    // protected function createSlug($string)
    // {
    //     $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
    //     return trim($slug, '-');
    // }
}
