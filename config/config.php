<?php
// Configuration settings
// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL', 'http://fpoly-booking.test/');
define('BASE_URL_ADMIN', 'http://fpoly-booking.test/admin/');
define('BASE_URL_MANAGE', 'http://fpoly-booking.test/manage/');
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'booking_class');
define('DB_CHARSET', 'utf8');
// đẩy đường dẫn lên cấp cao nhất
define('PATH_ROOT', __DIR__ . '/../');