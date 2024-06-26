<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Support/Support.php';
require_once __DIR__ . '/../config/config.php';

start_session();

use App\Controllers\Admin\UserAdminController;
use App\Controllers\DashboardController;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$url = $_GET['url'] ?? '/';

try {
    $router = new RouteCollector();

    // create route is here
    // start route 
    $router->get('/login', [DashboardController::class, 'login']);

    $router->post('/auth/login', [UserAdminController::class, 'login']);

    $router->get('/', [DashboardController::class, 'index']);

    $router->get('/logout', [DashboardController::class, 'logout']);

    // end route
    $routeData = $router->getData();
    // Kiểm tra dữ liệu router
    // dd($routeData);

    $dispatcher = new Dispatcher($router->getData());

    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

    echo $response;
} catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
    dd($e->getMessage());
} catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
    dd($e->getMessage());
} catch (Exception $e) {
    dd($e->getMessage());
}
