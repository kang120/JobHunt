<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->get('/home2', 'HomeController::home2');
$routes->get('/search_job', 'HomeController::search_job');

// Candidate Site
$routes->get('/candidate/signup', 'CandidateController::signup');
$routes->post('/candidate/signup', 'CandidateController::signup');
$routes->get('/candidate/signup/validation', 'CandidateController::signup_validation');
$routes->post('/candidate/signup/validation', 'CandidateController::signup_validation');
$routes->get('/candidate/signup/setup_profile', 'CandidateController::setup_profile');
$routes->get('/candidate/profile', 'CandidateController::profile');

$routes->get('/test', 'HomeController::test');

// Employer Site
$routes->get('/employer/update_job', 'EmployerController::update_job');
$routes->get('/employer/add_job', 'EmployerController::add_job');
$routes->get('/employer/edit_applications', 'EmployerController::edit_applications');
$routes->get('/employer/job_post', 'EmployerController::job_post');
$routes->get('/employer/company_profile', 'EmployerController::company_profile');
$routes->get('/employer/profile', 'EmployerController::profile');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
