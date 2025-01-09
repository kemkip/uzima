<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
     return view('auth.login');
});

Auth::routes();



Route::group( ['middleware' => 'auth' ], function()
{   

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');    
    Route::resource('roles',  App\Http\Controllers\RolesController::class);
    Route::post('update-permission',  [App\Http\Controllers\RolesController::class,'update_permission']);
    Route::post('update-role',  [App\Http\Controllers\RolesController::class,'update_role']);
    Route::get('users/profile',  [App\Http\Controllers\UsersController::class,'profile']);
    Route::get('users/profile-edit',  [App\Http\Controllers\UsersController::class,'profile_edit']);
    Route::post('users/profile-update',  [App\Http\Controllers\UsersController::class,'profile_update']);
    Route::get('users/password-edit',  [App\Http\Controllers\UsersController::class,'password_edit']);
    Route::post('users/password-update',  [App\Http\Controllers\UsersController::class,'password_update']);
    Route::post('switch-user',  [App\Http\Controllers\UsersController::class,'switch_user']);
    Route::get('users/password-reset/{email}/{id}',  [App\Http\Controllers\UsersController::class,'password_reset']);  
    Route::resource('users',  App\Http\Controllers\UsersController::class);

    Route::resource('countries',  App\Http\Controllers\CountryController::class);
    Route::resource('facilities',  App\Http\Controllers\FacilityController::class);
    Route::resource('patientcategories',  App\Http\Controllers\PatientcategoryController::class);
    Route::resource('diagnoses',  App\Http\Controllers\DiagnosisController::class);
    Route::resource('patients',  App\Http\Controllers\PatientController::class);

    Route::resource('specializations',  App\Http\Controllers\SpecializationController::class);
    Route::resource('practitioners',  App\Http\Controllers\PractitionerController::class);
    Route::resource('outreferrals',  App\Http\Controllers\OutreferralController::class);
    Route::resource('inreferrals',  App\Http\Controllers\InreferralController::class);

     /*Data Uploads Start*/

    Route::get('upload-countries', [App\Http\Controllers\CountryController::class, 'upload']);
    Route::post('post-upload-countries', [App\Http\Controllers\CountryController::class, 'post_upload_countries']);


     Route::resource('smses',  App\Http\Controllers\SmsController::class);

    //Route::post('smses/create',  [App\Http\Controllers\SmsController::class,'create']);
  
});
