# fpoly-booking
Nền tảng đặt phòng online cho Trường Cao đẳng FPT Polytechnic Hà Nam

# Setup
1. Tải thư viện vendor 
    - Terminal: composer install
    - Sửa lại file config.php trong thư mục config để phù hợp với Database:  
  
    ```
        <?php
        // Configuration settings
        // Biến môi trường, dùng chung toàn hệ thống
        // Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

        define('BASE_URL', 'http://fpoly-booking.test/');
        define('BASE_URL_ADMIN', 'http://fpoly-booking.test/admin/');
        define('BASE_URL_MANAGE', 'http://fpoly-booking.test/manage/');
        define('DB_HOST', 'localhost');
        define('DB_PORT', 3306);
        define('DB_USERNAME', '');
        define('DB_PASSWORD', '');
        define('DB_NAME', '');
        define('DB_CHARSET', 'utf8');
        // đẩy đường dẫn lên cấp cao nhất
        define('PATH_ROOT', __DIR__ . '/../');
        ?>
    ```

# Chú ý:
-  Tất cả các define mặc định nằm trong config/config.php, thiết lập trước khi sử dụng

-  Các config là riêng nên không upload lên server

- Các router phải viết thêm tiền tố để phân biệt, VD admin/login, admin/register, manage/room, user/check,....
