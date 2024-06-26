<?php

namespace App\Controllers;

use eftec\bladeone\BladeOne;

class BaseController
{
    /**
     * Render một view Blade.
     *
     * @param string $viewFile Tên file view cần render.
     * @param array $data Dữ liệu truyền vào view.
     * 
     * Cách sử dụng:
     * $this->render('home', ['name' => 'John']);
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
     * 
     * Cách sử dụng:
     * $friendlyError = $this->getFriendlyErrorMessage($sqlError);
     */
    protected function getFriendlyErrorMessage($error)
    {
        $errorMessages = [
            'Cannot delete or update a parent row: a foreign key constraint fails' => 'Không thể xóa bản ghi này vì nó liên quan đến các bản ghi khác.',
            'Duplicate entry' => 'Bản ghi với thông tin này đã tồn tại.',
            'Data too long for column' => 'Dữ liệu cung cấp quá dài cho một trong các trường.',
            'Incorrect integer value' => 'Giá trị không đúng cho trường kiểu số nguyên.',
            'Cannot add or update a child row: a foreign key constraint fails' => 'Không thể thêm hoặc cập nhật bản ghi này vì nó tham chiếu đến một bản ghi không hợp lệ.',
        ];

        foreach ($errorMessages as $pattern => $message) {
            if (strpos($error, $pattern) !== false) {
                return $message;
            }
        }

        return 'Đã xảy ra lỗi: ' . $error;
    }

    /**
     * Xác thực dữ liệu yêu cầu theo các quy tắc.
     *
     * @param array $data Dữ liệu yêu cầu.
     * @param array $rules Các quy tắc xác thực.
     * @return array Một mảng các thông báo lỗi, nếu có.
     * 
     * Cách sử dụng:
     * $errors = $this->validateRequest($_POST, ['name' => 'required']);
     * if (!empty($errors)) {
     *     // Xử lý lỗi
     * }
     */
    protected function validateRequest($data, $rules)
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
     * Chuyển hướng đến một URL cụ thể.
     *
     * @param string $url URL để chuyển hướng.
     * 
     * Cách sử dụng:
     * $this->redirect('/home');
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
     * 
     * Cách sử dụng:
     * $this->jsonResponse(['success' => true]);
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
     * 
     * Cách sử dụng:
     * if ($this->isPost()) {
     *     // Xử lý yêu cầu POST
     * }
     */
    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Kiểm tra nếu phương thức yêu cầu là GET.
     *
     * @return bool Trả về true nếu là GET, ngược lại false.
     * 
     * Cách sử dụng:
     * if ($this->isGet()) {
     *     // Xử lý yêu cầu GET
     * }
     */
    protected function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * Kiểm tra nếu phương thức yêu cầu là PUT.
     *
     * @return bool Trả về true nếu là PUT, ngược lại false.
     * 
     * Cách sử dụng:
     * if ($this->isPut()) {
     *     // Xử lý yêu cầu PUT
     * }
     */
    protected function isPut()
    {
        return $_SERVER['REQUEST_METHOD'] === 'PUT';
    }

    /**
     * Kiểm tra nếu phương thức yêu cầu là DELETE.
     *
     * @return bool Trả về true nếu là DELETE, ngược lại false.
     * 
     * Cách sử dụng:
     * if ($this->isDelete()) {
     *     // Xử lý yêu cầu DELETE
     * }
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
     * 
     * Cách sử dụng:
     * $value = $this->getInput('name', 'default');
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
     * 
     * Cách sử dụng:
     * $this->setFlash('success', 'Đăng nhập thành công');
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
     * 
     * Cách sử dụng:
     * $message = $this->getFlash('success');
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
     * 
     * Cách sử dụng:
     * $user = $this->auth();
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
     * 
     * Cách sử dụng:
     * $this->setAuth($user);
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
     * 
     * Cách sử dụng:
     * $this->destroyAuth();
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
     * 
     * Cách sử dụng:
     * $cleanData = $this->sanitize($inputData);
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
     * 
     * Cách sử dụng:
     * $formattedDate = $this->formatDate('2024-01-01', 'd/m/Y');
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
     * Ghi log lỗi vào file.
     *
     * @param string $errorMessage Nội dung lỗi cần ghi log.
     * 
     * Cách sử dụng:
     * $this->logError('Lỗi không xác định');
     */
    protected function logError($errorMessage)
    {
        $logFile = __DIR__ . "/../../storage/error.log";
        $logMessage = '[' . date('Y-m-d H:i:s') . '] ' . $errorMessage . PHP_EOL;
        error_log($logMessage, 3, $logFile);
    }

    

    /**
     * Xử lý tệp tải lên và lưu vào thư mục chỉ định.
     *
     * @param string $fileField Tên trường tệp trong yêu cầu.
     * @param string $uploadDir Đường dẫn thư mục lưu trữ tệp tải lên.
     * @param array $allowedExtensions Mảng các phần mở rộng tệp cho phép.
     * @return string|false Đường dẫn tới tệp đã tải lên hoặc false nếu có lỗi.
     * 
     * Cách sử dụng:
     * $uploadedFile = $this->handleUploadFile('avatar', '/uploads', ['jpg', 'png']);
     */
    protected function handleUploadFile($fileField, $uploadDir, $allowedExtensions)
    {
        if (!isset($_FILES[$fileField])) {
            return false;
        }

        $file = $_FILES[$fileField];
        $fileName = basename($file['name']);
        $targetPath = $uploadDir . '/' . $fileName;
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            return false;
        }

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $targetPath;
        } else {
            return false;
        }
    }


    /**
     * Chuyển hướng trở lại trang trước đó.
     * Cách sử dụng:
     * $this->back();
     */
    protected function back()
    {
        $url = $_SERVER['HTTP_REFERER'] ?? '/';
        header("Location: $url");
        exit();
    }

    /**
     * Phân trang cho kết quả truy vấn.
     *
     * @param int $currentPage Trang hiện tại.
     * @param int $perPage Số bản ghi trên mỗi trang.
     * @param int $totalItems Tổng số bản ghi.
     * @param string $baseUrl URL cơ sở của phân trang.
     * @return array Thông tin phân trang (trang hiện tại, tổng số trang).
     * 
     * Cách sử dụng:
     * $pagination = $this->paginate(1, 10, 100, '/products');
     */
    protected function paginate($currentPage, $perPage, $totalItems, $baseUrl)
    {
        $totalPages = ceil($totalItems / $perPage);
        return [
            'current_page' => $currentPage,
            'total_pages' => $totalPages,
            'base_url' => $baseUrl,
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
