<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->get('/', 'Home::login');
$routes->get('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->get('/register', 'Home::register');
$routes->get('/forgot-password-1', 'Home::forgot_password_1');
$routes->get('/forgot-password-2', 'Home::forgot_password_2');
$routes->get('/forgot-password-3', 'Home::forgot_password_3');
$routes->get('/resend-code', 'Home::resendCode');

//User Authentication
$routes->post('/register', 'Authentication::register');
$routes->post('/resend-code', 'Authentication::resendCode');
$routes->get('/verify/(:any)', 'Authentication::verifyAccount/$1');
$routes->post('/login', 'Authentication::login');

//Dashboard
$routes->get('/dashboard', 'Dashboard::dashboard');