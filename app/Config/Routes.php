<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');


$routes->get('/', 'Clients\AuthController::login');
$routes->post('/auth/verifier', 'Clients\AuthController::verifier');
$routes->get('/auth/logout', 'Clients\AuthController::logout');


$routes->get('/client/dashboard', 'Clients\DashboardController::index');