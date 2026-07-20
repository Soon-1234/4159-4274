<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');


//login
$routes->get('/', 'Clients\AuthController::login');
$routes->post('/auth/verifier', 'Clients\AuthController::verifier');
$routes->get('/auth/logout', 'Clients\AuthController::logout');
$routes->get('operateur/login', 'Operateurs\AuthController::login');
$routes->post('operateur/verifier', 'Operateurs\AuthController::verifier');
$routes->get('operateur/logout', 'Operateurs\AuthController::logout');

// Routes opérateur protégées
$routes->group('operateur', ['filter' => 'auth:operateur'], function ($routes) {
    $routes->get('dashboard', 'Operateurs\DashboardController::index');
    $routes->get('prefixes', 'Operateurs\PrefixeController::index');
    $routes->post('prefixes/store', 'Operateurs\PrefixeController::store');
    $routes->post('prefixes/delete/(:num)', 'Operateurs\PrefixeController::delete/$1');
    $routes->get('autres-operateurs', 'Operateurs\AutreOperateurController::index');
    $routes->post('autres-operateurs/store', 'Operateurs\AutreOperateurController::store');
    $routes->post('autres-operateurs/delete/(:num)', 'Operateurs\AutreOperateurController::delete/$1');
    $routes->post('autres-operateurs/commission', 'Operateurs\AutreOperateurController::updateCommission');

    $routes->get('autres-operateurs/prefixes/(:num)', 'Operateurs\AutreOperateurController::prefixes/$1');
    $routes->post('autres-operateurs/prefixes/(:num)/store', 'Operateurs\AutreOperateurController::storePrefixe/$1');
    $routes->post('autres-operateurs/prefixes/delete/(:num)', 'Operateurs\AutreOperateurController::deletePrefixe/$1');
    $routes->get('types-operation', 'Operateurs\TypeOperationController::index');
    $routes->get('envois-operateurs', 'Operateurs\EnvoiOperateurController::index');
    $routes->get('baremes/(:num)', 'Operateurs\BaremeFraisController::index/$1');
    $routes->post('baremes/(:num)/store', 'Operateurs\BaremeFraisController::store/$1');
    $routes->post('baremes/update/(:num)', 'Operateurs\BaremeFraisController::update/$1');
    $routes->post('baremes/delete/(:num)', 'Operateurs\BaremeFraisController::delete/$1');

    $routes->get('clients', 'Operateurs\ClientController::index');

    $routes->get('gains', 'Operateurs\GainController::index');
});



$routes->group('client', ['filter' => 'auth:client'], function ($routes) {
    $routes->get('dashboard', 'Clients\DashboardController::index');

    $routes->get('dashboard', 'Clients\DashboardController::index');

    //depot
    $routes->get('depot', 'Clients\OperationController::depot');
    $routes->post('depot/valider', 'Clients\OperationController::depotValider');

    //retrait
    $routes->get('retrait', 'Clients\OperationController::retrait');
    $routes->post('retrait/valider', 'Clients\OperationController::retraitValider');

    //transfert
    $routes->get('transfert', 'Clients\OperationController::transfert');
    $routes->post('transfert/valider', 'Clients\OperationController::transfertValider');

    //historique
    $routes->get('historique', 'Clients\OperationController::historique');


    //evoi multiple
    $routes->get('envoi-multiple', 'Clients\OperationController::envoiMultiple');
    $routes->post('envoi-multiple/valider', 'Clients\OperationController::envoiMultipleValider');
});
