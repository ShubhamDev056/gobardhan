<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
//$routes->set404Override();

$routes->set404Override(function() {
	return view('404');
});

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/access-denied', 'Home::accessDenied'); 
$routes->get('/design-2', 'Home::designV2');  
$routes->get('/design-3', 'Home::designV3');  


$routes->get('/', 'Home::index'); 
// $routes->get('/login', 'LoginController::login'); 
$routes->get('/login', 'Home::index'); 
$routes->post('/auth', 'LoginController::auth'); 
$routes->get('/logout', 'LoginController::logout'); 
$routes->get('/registration-overview', 'RegistrationController::regOverview');
$routes->get('/registration', 'RegistrationController::index');
$routes->post('/registration-save', 'RegistrationController::saveRegistration');
$routes->get('/registration-complete', 'RegistrationController::registrationSuccess');
$routes->get('/about-us', 'Home::aboutUs');
$routes->get('/contact', 'Home::contact');
$routes->get('/satat-nodal-officer', 'Home::satatContact');
$routes->get('/state-nodal-officer', 'Home::stateContact');
$routes->get('/benefits', 'Home::benefits'); 
$routes->get('/important-circular', 'CircularController::index');


//$routes->get('/otp-verification', 'RegistrationController::verifyOtp');
$routes->get('/reg-captcha', 'RegistrationController::captchaImage');
$routes->get('/refresh-captcha', 'LoginController::LoginCaptchaImage');
$routes->get('/gas-linkage', 'AjaxController::gasLinkage');
$routes->post('/send-otp', 'RegistrationController::sendOTP');
$routes->post('/verify-otp', 'RegistrationController::verifyOTP');
$routes->get('/district', 'DistrictController::index');
$routes->match(['get', 'post'],'/forgot-username', 'RegistrationController::forgotUsername');
$routes->match(['get', 'post'],'/forgot-password', 'RegistrationController::forgotDetails');
$routes->post('/send-forget-otp', 'RegistrationController::sendOTPForgot');
$routes->post('/verify-forget-otp', 'RegistrationController::verifyForgotOTP');
$routes->post('/verify-forget-otp-username', 'RegistrationController::verifyForgotOTPUsername');
$routes->get('/success', 'RegistrationController::seccessMsg');
$routes->post('/get-plantDetails', 'AjaxController::plantDetails');

$routes->get('/test', 'LoginController::test');
$routes->get('/test-captch', 'TestController::checkCaptcha');

$routes->match(['get', 'post'],'/grievance', 'GrievanceController::grievance');
$routes->get('/refresh-grievancecaptcha', 'GrievanceController::captchaImage');
$routes->get('/grievance-list', 'GrievanceController::grievanceList');
$routes->get('/grievance-details/(:num)', 'GrievanceController::grievanceDetails/$1');



///AUTH ROUTE
$routes->get('/add-project', 'ProjectController::addProject',['filter' => 'authGuard']);
$routes->get('/add-project-test', 'ProjectController::addProjectTest',['filter' => 'authGuard']);
$routes->get('/profile', 'RegistrationController::profile',['filter' => 'authGuard']);
$routes->post('/update-profile', 'RegistrationController::updateProfile',['filter' => 'authGuard']);
$routes->post('/change-password', 'RegistrationController::changePass',['filter' => 'authGuard']);
//$routes->get('/project-detail/(:num)', 'ProjectController::projectDetail/$1',['filter' => 'authGuard']);
$routes->match(['get', 'post'],'/add-bank-details/(:num)', 'BankController::addBank/$1',['filter' => 'authGuard']);
$routes->get('/applied-loan', 'BankController::appliedLoans',['filter' => 'authGuard']); 
$routes->post('/change-loan-status', 'BankController::updateLoanStatus',['filter' => 'authGuard']); 
$routes->post('/loan-remarks', 'BankController::updateLoanRemarks',['filter' => 'authGuard']); 
$routes->post('/loan-remarks-plants', 'BankController::updateLoanRemarksPlant',['filter' => 'authGuard']); 
//$routes->get('/organization-registration', 'OrganizationController::ORGRegister',['filter' => 'authGuard']);
$routes->match(['get', 'post'],'/organization-registration', 'OrganizationController::ORGRegister',['filter' => 'authGuard']);
$routes->match(['get', 'post'],'/organization-edit', 'OrganizationController::ORGEdit',['filter' => 'authGuard']);
$routes->post('/get-subtype', 'AjaxController::subType');
$routes->post('/get-plantType', 'AjaxController::plantType');
$routes->post('/get-agencyType', 'AjaxController::agencyType');
$routes->post('/get-districts', 'AjaxController::getDistricts');
$routes->post('/get-blocks', 'AjaxController::getBlocks');
$routes->post('/get-grampanchayats', 'AjaxController::getGPs');
$routes->post('/get-villages', 'AjaxController::getVillages');
$routes->post('/get-ulb', 'AjaxController::getULB',['filter' => 'authGuard']);
$routes->post('/get-projects', 'AjaxController::getProjects');


//save add project data route step by step
$routes->post('/reg-purpose', 'AjaxController::saveRegPurposeData',['filter' => 'authGuard']);
$routes->post('/project-data', 'AjaxController::saveProjectData',['filter' => 'authGuard']);
$routes->post('/location-data', 'AjaxController::saveLocationData',['filter' => 'authGuard']);
$routes->post('/physical-data', 'AjaxController::savePhysicalData',['filter' => 'authGuard']);


$routes->get('/circular', 'CircularController::circularList',['filter' => 'authGuard']);
$routes->match(['get', 'post'],'/add-circular', 'CircularController::circularAdd',['filter' => 'authGuard']);
$routes->get('/circular-delete/(:num)', 'CircularController::circularDelete/$1',['filter' => 'authGuard']);


/// ADMIN ROUTE
$routes->get('/dashboard', 'DashboardController::abc',['filter' => 'authGuard']);
$routes->get('/state-dashboard', 'DashboardController::stateDashboard',['filter' => 'authGuard']);
$routes->get('/entity-list', 'OrganizationController::index',['filter' => 'authGuard']);
$routes->get('/entity-details', 'OrganizationController::entityInfo',['filter' => 'authGuard']);
$routes->get('/project-details/(:num)', 'ProjectController::projectInfo/$1',['filter' => 'authGuard']);
$routes->get('/p-details/(:num)', 'ProjectController::projectInfo/$1');
$routes->get('/project-edit/(:num)', 'ProjectController::projectEdit/$1',['filter' => 'authGuard']);
$routes->get('/project-delete/(:num)', 'ProjectController::projectDelete/$1',['filter' => 'authGuard']);
$routes->get('/certifying-authority', 'ProjectController::certifyAuthority',['filter' => 'authGuard']);

$routes->get('/locate-plants', 'ProjectController::locatePlant');
$routes->match(['get', 'post'],'/registration-certificate', 'ProjectController::regCertificate');
$routes->get('/state-biogas', 'ProjectController::biogasStateReports');
$routes->get('/district-biogas', 'ProjectController::biogasDistrictReports');
$routes->get('/state-cbg', 'ProjectController::cbgStateReports');
$routes->get('/district-cbg', 'ProjectController::cbgDistrictReports');

$routes->get('/send-certificate', 'AjaxController::sendCertificateMail');
$routes->get('/generate-certificate', 'PdfController::htmlToPDF');
$routes->get('/view-certificate', 'PdfController::index');
$routes->get('/ss-sendmail', 'TestController::index');
$routes->get('/generate-certificate-temp', 'PdfController::htmlToPDFTemp');
$routes->get('/create-certificate/(:num)', 'PdfController::createCertificate/$1');
$routes->get('/plant-list', 'ProjectController::allPlants',['filter' => 'authGuard']);
$routes->get('/plants-list', 'ProjectController::allPlantsMinistry',['filter' => 'authGuard']);
$routes->get('/cbg-plants', 'ProjectController::allCbgPlants',['filter' => 'authGuard']);
$routes->get('/update-plant-date', 'ProjectController::updatePDate',['filter' => 'authGuard']);
$routes->post('/changedate', 'ProjectController::changeDate',['filter' => 'authGuard']);

$routes->get('/duplicate-biogas', 'ProjectController::DuplicateBiogas',['filter' => 'authGuard']);
$routes->get('/duplicate-cbg', 'ProjectController::DuplicateCBG',['filter' => 'authGuard']);
$routes->get('/export-all-projects', 'ProjectController::exportAllProjects'); 
$routes->get('/export-all-cbg-projects', 'ProjectController::exportAllCbgProjects'); 
$routes->get('/make-certificate/(:num)', 'PdfController::makeCertificate/$1'); 
$routes->get('/export', 'TestController::exportdata');
$routes->post('/download-excel', 'TestController::downloadData');

$routes->get('/push-data-sbm', 'ProjectController::pushDataSbm');
$routes->get('/push-data-sbm-villagewise', 'ProjectController::pushDataSbmVillageWise');
$routes->get('/monthly-log', 'ProjectController::monthlyPlants');
$routes->get('/monthly-ddws-log', 'ProjectController::monthlyPlantsDDWS'); 


$routes->get('/state-plant', 'ProjectController::statePlants');
$routes->get('/export-state-plant', 'ProjectController::exportStatePlants');
$routes->get('/state-report', 'ProjectController::stateReport');
$routes->get('/ministry-report', 'ProjectController::mReport');
$routes->get('/ddws-report', 'ProjectController::ddwsReport');
$routes->get('/ddws-report-district/(:num)', 'ProjectController::ddwsReportDistrictWise/$1');
$routes->get('/monthly-update', 'ProjectController::monthlyUpdate',['filter' => 'authGuard']);
$routes->post('/monthly-reported', 'ProjectController::monthlyReported',['filter' => 'authGuard']);
$routes->post('/monthly-reportedv1', 'ProjectController::monthlyReportedv1',['filter' => 'authGuard']);
$routes->get('/monthly-report', 'ProjectController::monthlyReport',['filter' => 'authGuard']);
$routes->get('/monthly-cbg-report', 'ProjectController::monthlyCBGReport',['filter' => 'authGuard']);
$routes->get('/monthly-report-details/(:num)', 'ProjectController::monthlyReportDetails/$1',['filter' => 'authGuard']);
$routes->get('/monthly-update-report', 'ProjectController::monthlyUpdtateReport',['filter' => 'authGuard']);
$routes->get('/monthly-update-report-cbg', 'ProjectController::monthlyUpdtateReportCBG',['filter' => 'authGuard']);
$routes->post('/temp-to-functional', 'ProjectController::monthlyTmpFun',['filter' => 'authGuard']);
$routes->get('/state-wise-monthly-report', 'ProjectController::monthlyreportState',['filter' => 'authGuard']);
$routes->get('/state-wise-monthly-report-cbg', 'ProjectController::monthlyreportStateCBG',['filter' => 'authGuard']);
$routes->get('/monthly-update-details/(:num)', 'ProjectController::monthlyUpdateDetails/$1',['filter' => 'authGuard']);
$routes->get('/monthly-update-cbg', 'ProjectController::monthlyUpdateCBG',['filter' => 'authGuard']);
$routes->get('/monthly-update-cbg-report/(:num)', 'ProjectController::monthlyUpdateCBGReport/$1',['filter' => 'authGuard']);


$routes->get('/ddwsBiogasReport', 'TestController::ddwsBiogasReport');
$routes->get('/excel-export', 'ExportController::abc');
$routes->get('/applied-loan-export', 'ExportController::appliedLoanExport',['filter' => 'authGuard']);
$routes->get('/monthly-update-report-export', 'ExportController::monthlyUpdtateReportExport',['filter' => 'authGuard']);

// MDA ISSUES MODULE
$routes->match(['get', 'post'],'/add-mda-issue/(:num)', 'IssueController::createMdaIssue/$1',['filter' => 'authGuard']);
$routes->get('/mda-issues', 'IssueController::mdaAllIssues',['filter' => 'authGuard']);
$routes->get('/mda-issues-details/(:num)', 'IssueController::mdaAllIssuesDetails/$1',['filter' => 'authGuard']);
$routes->post('/mda-issues-remarks', 'IssueController::mdaIssuesRemarks',['filter' => 'authGuard']);

// OFFTAKE ISSUES MODULE
$routes->match(['get', 'post'],'/add-offtake-issue/(:num)', 'IssueController::createOfftakeIssue/$1',['filter' => 'authGuard']);
$routes->get('/offtake-issues', 'IssueController::OfftakeAllIssues',['filter' => 'authGuard']);
$routes->get('/offtake-issues-details/(:num)', 'IssueController::offtakeAllIssuesDetails/$1',['filter' => 'authGuard']);
$routes->post('/offtake-issues-remarks', 'IssueController::offtakeIssuesRemarks',['filter' => 'authGuard']);


$routes->get('/all-reports', 'ProjectController::reportMenu',['filter' => 'authGuard']);

/*
2344max CBG PLANTS CERTIFICATE PUBLISHED
1. Animal Husbandry Infrastructure Development Fund (AHIDF) - Department of Animal Husbandry & Dairying (DAHD)
2. Agri Infrastructure Fund (AIF)- Department of Agriculture & Farmers Welfare (DA&FW)
3. Central Finance Assistance (Waste to Energy- Ministry of New and Renewable Energy (MNRE)
4. Swachh Bharat Mission - Urban (Additional Central Assistance)- Ministry of Housing and Urban Affairs (MoHUA)
5. Compressed Bio Gas offtake (Sustainable Alternative Towards Affordable Transportation (SATAT)- Ministry of Petroleum and Natural Gas (MoPNG))
6. Swachh Bharat Mission (Gramin)- Department of Drinking Water and Sanitation (DDWS)
7. Market Development Assistance (MDA) - Department of Fertilizer (DoF)
*/


///PULL DATA FROM MINISTRY API
/// Agri Infrastructure Fund (AIF)- Department of Agriculture & Farmers Welfare (DA&FW)
// $routes->get('get-aif-data', 'MinistryController::getAIFdata',['filter' => 'authGuard']);
//$routes->get("get-mopng-data", "MinistryController::getMoPNGdata");
// $routes->get("get-mnre-data", "MinistryController::getMNREdata");
$routes->get('ministry-data-list', 'MinistryController::ministry_data',['filter' => 'authGuard']);
$routes->post('inform-all', 'MinistryController::sendmailtoAll',['filter' => 'authGuard']);
$routes->post('/check-project', 'MinistryController::checkmProject',['filter' => 'authGuard']); 

$routes->get('/sendmail-multi', 'TestController::sendmailMultiple'); 

///API
$routes->group("api", function ($routes) { 
	$routes->get("state-wise-plants", "APIController::stateWisePlants",['filter' => 'basicAuth']);
	$routes->get("project", "APIController::index",['filter' => 'basicAuth']);
	$routes->put("update-project/(:any)", "APIController::updateProject/$1",['filter' => 'basicAuth']);
	$routes->get("district-wise-biogas-plants/(:num)", "APIController::districtBiogasWisePlants/$1",['filter' => 'basicAuth']);
});

// $routes->group("api", ["namespace" => "App\Controllers\Api", "filter" => "basicauth"] , function($routes){
	// $routes->get("list-project", "ApiController::listProject");
// });




$routes->group("testapi", function ($routes) { 
	$routes->get("state-biogasplants", "APITestController::biogasPlantStateWise");
	$routes->get("satat-nodal-officer", "APITestController::SATATNodalOfficer", ['filter' => 'basicAuth']);
	$routes->get("plant-details", "APITestController::plantDetails");
});


//----------------------------- SBM Master Directory --------------------
$routes->get('/sbm-master-directory-report', 'SBMMasterDirectory::locatePlant');
$routes->get('/sync-sbm-master-directory-data', 'SBMMasterDirectory::callApiAndUpsert');


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
