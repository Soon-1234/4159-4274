<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');


$routes->get('/', 'Clients\Auth::login');
$routes->post('/auth/verifier', 'Clients\Auth::verifier');
$routes->get('/auth/logout', 'Clients\Auth::logout');


$routes->get('/client/dashboard', 'Clients\DashboardController::index');