<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->addRedirect('/', '/login'); // Redirección de "/" a "/home"
$routes->get('/home', 'Home::index');


$routes->get('/register', 'AuthController::register');
$routes->get('/login', 'AuthController::login');
$routes->post('auth/store', 'AuthController::store');
$routes->post('auth/authenticate', 'AuthController::authenticate');
$routes->get('auth/logout', 'AuthController::logout');