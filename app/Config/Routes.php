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
$routes->get('/home/records-data', 'Home::recordsData', ['filter' => 'auth']);
$routes->get('/home/records-by-type', 'Home::recordsDataByType', ['filter' => 'auth']);
$routes->get('/new-password', 'UsersController::newPasswordView', ['filter' => 'auth']);
$routes->post('/new-password', 'UsersController::updateNewPassword', ['filter' => 'auth']);
$routes->get('/admin/settings', 'SettingsController::index', ['filter' => 'auth']);
$routes->post('/admin/settings/update', 'SettingsController::update', ['filter' => 'auth']);
$routes->get('/admin/users', 'UsersController::index', ['filter' => 'auth']);
$routes->get('/admin/users/create', 'UsersController::create', ['filter' => 'auth']);
$routes->post('/admin/users/store', 'UsersController::store', ['filter' => 'auth']);
$routes->get('/admin/users/(:num)', 'UsersController::view/$1', ['filter' => 'auth']);
$routes->get('/admin/users/(:num)/edit', 'UsersController::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/users/(:num)/update', 'UsersController::update/$1', ['filter' => 'auth']);
$routes->post('/admin/users/toggle-status/(:num)', 'UsersController::toggleStatus/$1', ['filter' => 'auth']);
$routes->post('/admin/users/reset-password/(:num)', 'UsersController::resetPassword/$1', ['filter' => 'auth']);
$routes->get('/admin/employees', 'EmployeesController::index', ['filter' => 'auth']);
$routes->get('/admin/employees/create', 'EmployeesController::create', ['filter' => 'auth']);
$routes->post('/admin/employees/store', 'EmployeesController::store', ['filter' => 'auth']);
$routes->get('/admin/employees/(:num)/edit', 'EmployeesController::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/employees/(:num)/update', 'EmployeesController::update/$1', ['filter' => 'auth']);
$routes->get('/admin/employees/(:num)', 'EmployeesController::view/$1', ['filter' => 'auth']);
$routes->post('/admin/employees/toggle-status/(:num)', 'EmployeesController::toggleStatus/$1', ['filter' => 'auth']);
$routes->get('/records', 'RecordsController::index', ['filter' => 'auth']);
$routes->get('/records/create', 'RecordsController::create', ['filter' => 'auth']);
$routes->get('records/create/(:segment)', 'RecordsController::createWithType/$1', ['filter' => 'auth']);
$routes->post('records/create/(:segment)', 'RecordsController::createWithType/$1', ['filter' => 'auth']);
$routes->get('records/preview/view', 'RecordsController::previewView', ['filter' => 'auth']);
$routes->post('records/preview', 'RecordsController::preview', ['filter' => 'auth']);
$routes->post('records/store', 'RecordsController::store', ['filter' => 'auth']);
$routes->post('records/generatePdf', 'RecordsController::generatePdf', ['filter' => 'auth']);
//$routes->put('/admin/users/(:num)', 'UsersController::update/$1', ['filter' => 'auth']);