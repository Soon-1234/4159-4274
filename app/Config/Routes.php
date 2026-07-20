<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');


$routes->get('/', 'Clients\AuthController::login');
$routes->post('/auth/verifier', 'Clients\AuthController::verifier');
$routes->get('/auth/logout', 'Clients\AuthController::logout');


$routes->group('client', ['filter' => 'auth:client'], function ($routes) {
    $routes->get('dashboard', 'Clients\DashboardController::index');
});