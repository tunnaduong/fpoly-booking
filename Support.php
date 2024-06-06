<?php
 // Support function here
// Hoạt động toàn cục
if(!function_exists('dd')){
    
    if (!function_exists('dd')) {
        function dd($data) {
            echo '<pre>';
            var_dump($data);
            echo '</pre>';
            die();
        }
    }
    
}

if(!function_exists('start_session')){
    function start_session(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }
}

if (!function_exists('set_session')) {
    function set_session($key, $value) {
        $_SESSION[$key] = $value;
    }
}

if (!function_exists('session_exists')) {
    function session_exists($key) {
        return isset($_SESSION[$key]);
    }
}

if (!function_exists('get_session')) {
    function get_session($key, $default = null) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }
}
