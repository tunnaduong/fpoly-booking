<?php
// Support function here
/*
    dd() => trả về lỗi
    start_session() => bắt đầu 1 phiên session
    set_session() => tạo 1 biến session
    session_exists() => kiểm tra 1 biến session đã tồn tại hay chưa
    get_session() => lấy giá trị của 1 biến session
*/
// Hoạt động toàn cục


if (!function_exists('dd')) {
    function dd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die();
    }
}

if (!function_exists('start_session')) {
    function start_session()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}

if (!function_exists('set_session')) {
    function set_session($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}

if (!function_exists('session_exists')) {
    function session_exists($key)
    {
        return isset($_SESSION[$key]);
    }
}

if (!function_exists('get_session')) {
    function get_session($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }
}

function convertToArray($variable = []): array
{
    if (is_array($variable)) {
        return $variable;
    } else {
        return [$variable];// Wrap the variable in an array and return it.
    }
}

function setVarAsDefault($var, array $data = []) 
{
    $var = convertToArray($var);
    if ($data == null) {
        return $var;
    } else {
        // array_diff_key: lọc key đã tồn tại trong mảng
        return array_merge($var, array_diff_key($data, $var));
    }
}
