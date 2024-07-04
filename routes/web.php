<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\branchController;
use App\Http\Controllers\StripeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*-------------------------Client Routes---------------------*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('contact', function () {
    return view('contact');
});

route::post('contact_action',[branchController::class,'home_contact_action']);

/*-------------------------Admin Routes---------------------*/
Route::get('/admin', function () {
    return view('admin.login');
});

route::post('admin/loginaction',[adminController::class,'adminloginaction']);

Route::get('/admin/login', function () {
    return view('admin.login');
});

// login Action
route::post('admin/loginaction',[adminController::class,'adminloginaction']);


Route::get('/admin/forget', function () {
    return view('admin.forget');
});
route::post('admin/forget_action',[adminController::class,'forget']);


// Middleware
Route::group(['middleware' => 'admin'], function () {

// Logout

route::get('admin/logout',[admincontroller::class,'adminlogout']);

// Business

route::get('/admin/add_business', [adminController::class,'add_business']);
route::get('/admin/view_businesses', [adminController::class,'view_business']);
route::post('admin/addbusinessaction',[adminController::class,'addbusinessaction']);
route::post('admin/edit_business_action',[adminController::class,'edit_business_action']);

route::get('/admin/business_delete/{id}', [adminController::class,'business_delete']);


//Business Detail
route::get('/admin/business_detail/{id}', [adminController::class,'business_detail']);



route::get('/admin/dashboard', [adminController::class,'admin_dashboard']);

//all companies
route::get('/admin/companies', [adminController::class,'companies']);
route::get('/admin/companies_detail/{id}', [adminController::class,'companies_detail']);
route::post('admin/edit_company_action',[adminController::class,'edit_company_action']);
route::get('/admin/company_delete/{id}', [adminController::class,'company_delete']);

//My companies
route::get('/admin/my_companies', [adminController::class,'my_companies']);

//employees

route::get('/admin/add_employees', [adminController::class,'add_employees']);
route::post('/admin/add_employee_action', [adminController::class,'add_employee_action']);
route::get('/admin/view_employees', [adminController::class,'view_employees']);
route::post('/admin/employee_show_action', [adminController::class,'employee_show_action']);
route::post('/admin/employee_detail_sale_action', [adminController::class,'employee_detail_sale_action']);
route::get('/admin/employee_detail/{id}', [adminController::class,'employee_detail']);
route::get('/admin/employee_delete/{id}', [adminController::class,'employee_delete']);
route::post('/admin/edit_employee_action', [adminController::class,'edit_employee_action']);

//Sales

route::get('/admin/add_sale', [adminController::class,'add_sale']);
route::post('/admin/add_sale_action', [adminController::class,'add_sale_action']);
route::post('/admin/add_employee_sale_action', [adminController::class,'add_employee_sale_action']);
route::get('/admin/view_sale', [adminController::class,'view_sale']);
route::post('/admin/view_sale_action', [adminController::class,'view_sale_action']);

//rewards
route::get('/admin/add_rewards', [adminController::class,'add_rewards']);
route::post('/admin/add_reward_action', [adminController::class,'add_reward_action']);
route::get('/admin/view_rewards', [adminController::class,'view_rewards']);
route::post('/admin/edit_reward_action', [adminController::class,'edit_reward_action']);
route::get('/admin/active_reward_delete/{id}', [adminController::class,'active_reward_delete']);
route::get('/admin/reward_history', [adminController::class,'reward_history']);
route::get('/admin/history_reward_delete/{id}', [adminController::class,'history_reward_delete']);

//licenses
route::get('/admin/add_license', [adminController::class,'add_license']);
route::get('/admin/view_license', [adminController::class,'view_license']);
route::post('/admin/add_license_action', [adminController::class,'add_license_action']);
route::post('/admin/edit_license_action', [adminController::class,'edit_license_action']);
route::get('/admin/license_delete/{id}', [adminController::class,'license_delete']);


//subscription packages
route::get('/admin/add_pkg', [adminController::class,'add_pkg']);
route::post('/admin/add_pkg_action', [adminController::class,'add_pkg_action']);
route::get('/admin/view_pkg', [adminController::class,'view_pkg']);
route::post('/admin/edit_pkg_action', [adminController::class,'edit_pkg_action']);

route::get('/admin/pkg_delete/{id}', [adminController::class,'pkg_delete']);

//subscribers
route::get('/admin/active_subscribers', [adminController::class,'active_subscribers']);
route::get('/admin/blocked_subscribers', [adminController::class,'blocked_subscribers']);

//license Organization
route::get('/admin/lnc_org', [adminController::class,'lnc_org']);
route::post('/admin/orgnameaction', [adminController::class,'orgnameaction']);
route::post('/admin/editorgnameaction', [adminController::class,'editorgnameaction']);

route::get('/admin/org_delete/{id}', [adminController::class,'org_delete']);


//license names
route::get('/admin/licenses', [adminController::class,'licenses']);
route::post('/admin/licensesnameaction', [adminController::class,'licensesnameaction']);
route::post('/admin/editlicensesnameaction', [adminController::class,'editlicensesnameaction']);

route::get('/admin/name_delete/{id}', [adminController::class,'name_delete']);

//transactions
route::get('/admin/transactions',[adminController::class,'transactions']);
route::get('/admin/trans_delete/{id}', [adminController::class,'trans_delete']);

//profile
route::get('/admin/profile', [adminController::class,'profile']);
route::post('/admin/profileeditaction', [adminController::class,'profileeditaction']);

//update password
route::get('/admin/update_password', [adminController::class,'update_password']);

route::post('/admin/update_password_action', [adminController::class,'update_password_action']);

});

/*-------------------------branch Routes---------------------*/
Route::get('/branch', function () 
{ return view('branch.login');

});

Route::get('/branch/login', function () {return view('branch.login');});


route::post('branch/login_action',[branchController::class,'branch_login_action']);


Route::get('/branch/forget', function () {
    return view('branch.forget');
});
route::post('branch/forget_action',[branchController::class,'forget']);
//signup
route::get('/branch/signup', [branchController::class,'signup']);
route::post('/branch/signupaction', [branchController::class,'signupaction']);
// Verification

Route::get('/branch/verification/{id}', [branchController::class,'verification']);
Route::post('/branch/verification_action', [branchController::class,'verification_action']);
Route::get('/branch/again_verification_action/{id}', [branchController::class,'again_verification_action']);
// Middleware
Route::group(['middleware' => 'branch'], function () {

//dashboard
route::get('/branch/dashboard', [branchController::class,'branch_dashboard']);



//profile
route::get('/branch/profile', [branchController::class,'profile']);
route::post('/branch/profileeditaction', [branchController::class,'profileeditaction']);


//My companies
route::get('/branch/my_companies', [branchController::class,'my_companies']);

route::get('/branch/companies_detail/{id}', [branchController::class,'companies_detail']);
route::post('branch/edit_company_action',[branchController::class,'edit_company_action']);
route::get('/branch/company_delete/{id}', [adminController::class,'company_delete']);


//business
route::get('/branch/add_business', [branchController::class,'add_business']);
route::get('/branch/view_business', [branchController::class,'view_business']);


route::post('branch/addbusinessaction',[branchController::class,'addbusinessaction']);
route::post('branch/edit_business_action',[branchController::class,'edit_business_action']);

route::get('/branch/business_delete/{id}', [branchController::class,'business_delete']);


//Business Detail
route::get('/branch/business_detail/{id}', [branchController::class,'business_detail']);




//employees


route::get('/branch/add_employee', [branchController::class,'add_employees']);
route::post('/branch/add_employee_action', [branchController::class,'add_employee_action']);
route::get('/branch/view_employee', [branchController::class,'view_employees']);

route::post('/branch/employee_show_action', [branchController::class,'employee_show_action']);

route::post('/branch/employee_detail_sale_action', [branchController::class,'employee_detail_sale_action']);


route::get('/branch/employee_detail/{id}', [branchController::class,'employee_detail']);

route::get('/branch/employee_delete/{id}', [branchController::class,'employee_delete']);
route::post('/branch/edit_employee_action', [branchController::class,'edit_employee_action']);


//rewards


route::get('/branch/add_rewards', [branchController::class,'add_rewards']);
route::post('/branch/add_reward_action', [branchController::class,'add_reward_action']);
route::get('/branch/view_rewards', [branchController::class,'view_rewards']);
route::post('/branch/edit_reward_action', [branchController::class,'edit_reward_action']);
route::get('/branch/active_reward_delete/{id}', [branchController::class,'active_reward_delete']);

route::get('/branch/reward_history', [branchController::class,'reward_history']);
route::get('/branch/history_reward_delete/{id}', [branchController::class,'history_reward_delete']);


//licenses
route::get('/branch/add_licenses', [branchController::class,'add_license']);
route::get('/branch/view_licenses', [branchController::class,'view_license']);
route::post('/branch/add_license_action', [branchController::class,'add_license_action']);
route::post('/branch/edit_license_action', [branchController::class,'edit_license_action']);
route::get('/branch/license_delete/{id}', [branchController::class,'license_delete']);




//Sales

route::get('/branch/add_sale', [branchController::class,'add_sale']);
route::post('/branch/add_sale_action', [branchController::class,'add_sale_action']);
route::post('/branch/add_employee_sale_action', [branchController::class,'add_employee_sale_action']);
route::get('/branch/view_sale', [branchController::class,'view_sale']);
route::post('/branch/view_sale_action', [branchController::class,'view_sale_action']);


//update password
route::get('/branch/update_password', [branchController::class,'update_password']);
route::post('/branch/update_password_action', [branchController::class,'update_password_action']);

// Stripe Payment 
Route::get('/branch/stripe/{id}', [StripeController::class, 'stripe']);
Route::post('branch/stripe', [StripeController::class, 'stripePost'])->name('branch/stripe.post');

// Logout

route::get('branch/logout',[branchcontroller::class,'branchlogout']);

});

