<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apicontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Login
route::post('login',[apicontroller::class,'login']);

// Profile
route::post('profile',[apicontroller::class,'profile']);
route::post('edit_profile',[apicontroller::class,'edit_profile']);

// Forget
route::post('forget',[apicontroller::class,'forget']);

// change password
route::post('change_password',[apicontroller::class,'change_password']);

// Home
route::post('home',[apicontroller::class,'home']);
route::post('home_chart',[apicontroller::class,'home_chart']);

// Reward
route::post('reward',[apicontroller::class,'reward']);

// License
route::post('create_license',[apicontroller::class,'create_license_action']);
route::post('license',[apicontroller::class,'license']);
route::post('edit_license',[apicontroller::class,'edit_license_action']);
route::post('license_delete',[apicontroller::class,'license_delete']);


// MY statistics
route::post('statistics',[apicontroller::class,'statistics']);



// Search Filter
route::post('search_filter',[apicontroller::class,'search_filter']);


// Add Reminder

route::post('add_reminder',[apicontroller::class,'add_reminder']);

// View Reminder
route::post('view_reminder',[apicontroller::class,'view_reminder']);

// Delete Reminder
route::post('delete_reminder',[apicontroller::class,'delete_reminder']);


// Add my_client

route::post('add_my_client',[apicontroller::class,'add_my_client']);

// View Client
route::post('view_my_client',[apicontroller::class,'view_my_client']);

// Delete Client
route::post('delete_my_client',[apicontroller::class,'delete_my_client']);

// Edit Client
route::post('edit_my_client',[apicontroller::class,'edit_my_client']);


// Weakly Sale
route::post('weakly_sale',[apicontroller::class,'weakly_sale']);

// Yearly sale
route::post('yearly_sale',[apicontroller::class,'yearly_sale']);

