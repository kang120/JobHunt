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
$routes->set404Override(function(){
	return view("errors/404");
});
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::home');
$routes->get('/home', 'HomeController::home');
$routes->get('/search_job', 'HomeController::search_job');
$routes->get('/job/details', 'HomeController::job_details');

// Candidate Site
$routes->get('/candidate/login', 'CandidateController::login');
$routes->post('/candidate/login', 'CandidateController::login');
$routes->get('/candidate/signup', 'CandidateController::signup');
$routes->post('/candidate/signup', 'CandidateController::signup');
$routes->get('/candidate/signup/validation', 'CandidateController::signup_validation');
$routes->post('/candidate/signup/validation', 'CandidateController::signup_validation');
$routes->get('/candidate/signup/setup_profile', 'CandidateController::setup_profile');

$routes->get('/candidate/profile', 'ProfileController::profile');
$routes->post('/candidate/profile/picture/upload', 'ProfileController::update_picture');
$routes->post('/candidate/profile/education', 'ProfileController::add_education');
$routes->post('/candidate/profile/experience', 'ProfileController::add_experience');
$routes->post('/candidate/profile/skills', 'ProfileController::add_skills');
$routes->post('/candidate/profile/language', 'ProfileController::add_language');
$routes->post('/candidate/profile/bio', 'ProfileController::update_bio');

$routes->post('/candidate/profile/education/delete', 'ProfileController::delete_education');
$routes->post('/candidate/profile/experience/delete', 'ProfileController::delete_experience');
$routes->post('/candidate/profile/skill/delete', 'ProfileController::delete_skill');
$routes->post('/candidate/profile/language/delete', 'ProfileController::delete_language');

$routes->get('/candidate/job/application', 'CandidateController::job_application');
$routes->post('/candidate/job/application', 'CandidateController::job_application');

$routes->get('/candidate/inquiry', 'CandidateController::inquiry');
$routes->post('/candidate/inquiry', 'CandidateController::inquiry');


// Admin Site
$routes->get('/admin', 'AdminController::home');
$routes->get('/admin/login', 'AdminController::login');
$routes->post('/admin/login', 'AdminController::login');
$routes->get('/admin/signout', 'AdminController::logout');
$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/admin/candidate', 'AdminController::candidate_management');
$routes->get('/admin/candidate_profile', 'AdminController::candidate_profile_management');
$routes->get('/admin/employer', 'AdminController::employer_management');
$routes->get('/admin/company', 'AdminController::company_management');
$routes->get('/admin/job', 'AdminController::job_management');
$routes->get('/admin/job_application', 'AdminController::job_application_management');
$routes->get('/admin/candidate_inquiry', 'AdminController::candidate_inquiry_management');
$routes->get('/admin/employer_inquiry', 'AdminController::employer_inquiry_management');
$routes->get('/admin/user', 'AdminController::admin_management');

$routes->post('/admin/candidate_inquiry', 'AdminController::candidate_inquiry_management');
$routes->post('/admin/employer_inquiry', 'AdminController::employer_inquiry_management');


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
