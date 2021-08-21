<?php

use App\Http\Controllers\TaskController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/about', function () {
//     return view('pages.about');
// });

Route::get('/', function () {
    return view('home');
});

//Route::get('/', 'App\Http\Controllers\PagesController@index');
Route::get('/about', 'App\Http\Controllers\PagesController@about');
Route::get('/services', 'App\Http\Controllers\PagesController@services');
Auth::routes(['verify'=>true]);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard')->middleware(["verified"]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(["verified"]);

//auth route for both 
Route::group(['middleware' => ['auth']], function() { 
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard')
    ->middleware(["verified"]);
});

// for tenants
// Route::group(['middleware' => ['auth', 'role:tenant']], function() { 
//     Route::get('/dashboard/myprofile', 'App\Http\Controllers\DashboardController@myprofile')->name('dashboard.myprofile');
// });

//auth route for both 
Route::group(['middleware' => ['auth']], function() { 
    Route::get('/dashboard/myprofile', 'App\Http\Controllers\DashboardController@myprofile')->name('dashboard.myprofile')
    ->middleware(["verified"]);
});

// for property managers
Route::group(['middleware' => ['auth']], function() { 
    Route::get('/dashboard/postrequest', 'App\Http\Controllers\DashboardController@postrequest')->name('dashboard.postrequest');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);

    Route::resource('users', \App\Http\Controllers\UsersController::class); 

    Route::resource('manager', \App\Http\Controllers\ManagerController::class);

    Route::resource('vendor', \App\Http\Controllers\VendorController::class);

    Route::resource('property', \App\Http\Controllers\PropertyController::class);

    Route::resource('tenants', \App\Http\Controllers\TenantController::class); 

    Route::resource('applicant', \App\Http\Controllers\ApplicantController::class);
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware('verified');



require __DIR__.'/auth.php';
