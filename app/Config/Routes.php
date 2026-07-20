<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');


//login
$routes->get('/', 'Clients\AuthController::login');
$routes->post('/auth/verifier', 'Clients\AuthController::verifier');
$routes->get('/auth/logout', 'Clients\AuthController::logout');


$routes->get('/client/dashboard', 'Clients\DashboardController::index');

//depot
$routes->get('/client/depot', 'Clients\OperationController::depot');
$routes->post('/client/depot/valider', 'Clients\OperationController::depotValider');

//retrait
$routes->get('/client/retrait', 'Clients\OperationController::retrait');
$routes->post('/client/retrait/valider', 'Clients\OperationController::retraitValider');

//transfert
$routes->get('/client/transfert', 'Clients\OperationController::transfert');
$routes->post('/client/transfert/valider', 'Clients\OperationController::transfertValider');

//historique
$routes->get('/client/historique', 'Clients\OperationController::historique');

