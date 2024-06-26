<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Support/Support.php';
require_once __DIR__ . '/../config/config.php';

start_session();

use App\Controllers\Admin\UserController;
use App\Controllers\DashboardController;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$url = $_GET['url'] ?? '/';

$router = new RouteCollector();
try {
    // create route is here
    // start route 
    $router->get('/login', [DashboardController::class, 'login']);

    $router->post('/auth/login', [UserController::class, 'login']);

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
    (new DashboardController())->error404();
} catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
    dd('2' . $e->getMessage());
} catch (Exception $e) {
    dd('3' . $e->getMessage());
}
