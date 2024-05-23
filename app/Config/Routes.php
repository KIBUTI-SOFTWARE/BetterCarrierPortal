<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->get('/', 'Home::login');
$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->get('/forgot-password-1', 'Home::forgot_password_1');
$routes->get('/forgot-password-2', 'Home::forgot_password_2');
$routes->get('/forgot-password-3', 'Home::forgot_password_3');
$routes->get('/resend-code', 'Home::resendCode');

//User Authentication
    // Account Registration, Activation(Verification), Login & Logout
$routes->post('/register', 'Authentication::register');
$routes->post('/resend-code', 'Authentication::resendCode');
$routes->get('/verify/(:any)', 'Authentication::verifyAccount/$1');
$routes->post('/login', 'Authentication::login');
$routes->get('/logout', 'Authentication::logout');

    //Password Recovery
$routes->post('/password-recovery-1', 'Authentication::verifyEmail');
$routes->get('/verify-link/(:any)', 'Authentication::verifyPasswordRecoveryLink/$1');
$routes->post('/forgot-password-2', 'Authentication::forgot_password_2');
$routes->post('/password-recovery-3', 'Authentication::setNewPassword');

//Dashboard
$routes->get('/dashboard', 'Dashboard::dashboard');