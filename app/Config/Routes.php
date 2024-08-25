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


//Users
    //User Profile
$routes->get('/view-profile', 'Profile::myProfile');
$routes->get('/profile-setup', 'Profile::profileSetup');
$routes->post('/profile-setup', 'Profile::profileSetupAction');
$routes->post('/change-password', 'Profile::updatePassword');
    //Users Management
$routes->post('/ajax/get-user', 'Users::getAJAXUser');
$routes->get('/view-users', 'Users::viewUsers');
$routes->get('/view-employers', 'Users::viewUsers');
$routes->get('/view-job-seekers', 'Users::viewUsers');
$routes->get('/view-user/(:any)', 'Users::viewUser/$1');
$routes->get('/user-profile', 'Users::userProfile');



//Job Posts && Applications
    //Job Posts
$routes->post('/ajax/get-job-post', 'JobPosts::getAJAXJobPost');
$routes->get('/view-job-posts', 'JobPosts::jobPosts');
$routes->get('/internship-posts', 'JobPosts::jobPosts');
$routes->get('/employment-posts', 'JobPosts::jobPosts');
$routes->get('/employment-posts', 'JobPosts::employmentPosts');
$routes->post('/new-job-post', 'JobPosts::newJobPost');
$routes->get('/view-job-post/(:any)', 'JobPosts::viewJobPost/$1');
$routes->get('/job-post-profile', 'JobPosts::jobPostProfile');
$routes->post('/update-job-post', 'JobPosts::updateJobPost');
    //Applications
$routes->get('/view-applications', 'JobApplications::jobPostApplications');
$routes->post('/apply-job', 'JobApplications::newJobApplication');


//Categories Management
$routes->post('/ajax/get-category', 'Categories::getAJAXCategory');
$routes->get('/categories', 'Categories::viewCategories');
$routes->post('/new-category', 'Categories::createCategory');
$routes->get('/view-category/(:any)', 'Categories::viewCategory/$1');
$routes->get('/category-profile', 'Categories::categoryProfile');
$routes->post('/categories/update-category', 'Categories::updateCategory');