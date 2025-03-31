<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->addRedirect('/', '/login'); // Redirección de "/" a "/home"



$routes->get('/register', 'AuthController::register');
$routes->get('/login', 'AuthController::login');
$routes->post('auth/store', 'AuthController::store');
$routes->post('auth/authenticate', 'AuthController::authenticate');
$routes->get('auth/logout', 'AuthController::logout');

$routes->get('/home', 'Home::index', ['filter' => 'auth']);
$routes->get('/new-password', 'UsersController::newPasswordView', ['filter' => 'auth']);
$routes->post('/new-password', 'UsersController::updateNewPassword', ['filter' => 'auth']);
$routes->get('/admin/settings', 'SettingsController::index', ['filter' => 'auth']);
$routes->post('/admin/settings/update', 'SettingsController::update', ['filter' => 'auth']);
$routes->get('/admin/users', 'UsersController::index', ['filter' => 'auth']);
$routes->get('/admin/users/create', 'UsersController::create', ['filter' => 'auth']);
$routes->post('/admin/users/store', 'UsersController::store', ['filter' => 'auth']);