<?php

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

use Illuminate\Support\Facades\DB;

Route::match(['GET','POST'],'/', function () {
    return redirect()->route('home');
});

Auth::routes(['verify' => true]);

Route::match(['GET','POST'],'/home', 'HomeController@index')->name('home');
Route::get('/jobs', 'HomeController@jobs')->name('jobs');
Route::get('/fetch-jobs', 'HomeController@fetchjobs');
Route::get('/jobs/description', 'HomeController@jobsdescription');
Route::get('/jobs/apply', 'Jobs\JobsCtrl@jobsapply')->middleware('verified');
Route::get('/jobs/apply/review', 'Jobs\JobsCtrl@jobsreview')->middleware('verified');
Route::get('/refresh_captcha', 'Auth\LoginController@refreshCaptcha');
Route::get('/select-section', 'FnctnCtrl@selectSection');
Route::get('/otp', 'HomeController@otp')->name('otp')->middleware('verified');
Route::post('/save-app-letter', 'Jobs\JobsCtrl@appLetter')->middleware('verified');
Route::get('/track-message/{id}', 'Jobs\JobsCtrl@trackMessage')->middleware('verified');
Route::group(['middleware' => 'superadmin'], function(){
	Route::match(['GET','POST'],'job-posting', 'Jobs\JobsCtrl@jobposting');
	Route::post('/save-update-job-post', 'Jobs\JobsCtrl@aeJobPost');
	Route::get('/jobs-edit/{id}', 'Jobs\JobsCtrl@jobsEdit');
	Route::get('/applicants', 'Jobs\JobsCtrl@applicants')->name('applicants');
	Route::get('/get-application-letter', 'Jobs\JobsCtrl@getAppLetter');
	Route::post('/message-applicant', 'Jobs\JobsCtrl@message');
    Route::post('/delete-message', 'Jobs\JobsCtrl@deletemessage');
	Route::get('/get-app-profile', 'Jobs\JobsCtrl@getAppProfile');
	Route::get('/list-applicants', 'Jobs\JobsCtrl@listApps');
	Route::get('/attendance', 'Jobs\JobsCtrl@attendance');
    Route::get('/attendance-interview', 'Jobs\JobsCtrl@attInter');
    Route::match(['GET','POST'],'/users', 'ProfileController@users');
    Route::get('/applicant/profile', 'Jobs\JobsCtrl@AppProfilev2');
    Route::post('/save-update-user', 'FnctnCtrl@storeUser');
    Route::get('/users-edit/{id}', 'FnctnCtrl@editUser');
});

// HRMIS API
Route::get('/hrmis-positions', 'HrmisApiCtrl@positionsJson');


// Cancel Application
Route::post('/cancel-application', 'Jobs\JobsCtrl@cancelApplication');

//Excel
Route::get('/excel/rdr/{appid}', 'Excel\ExcelCtrl@rdr')->middleware('verified');



Route::resource('profile','ProfileController');
Route::get('my-profile','ProfileController@myprofile')->middleware('verified');
//Route::get('my-profile-update','ProfileController@profileupdate');
//Route::get('save-application-update', 'ProfileController@applicationupdate');
Route::post('save-application-update', 'ProfileController@applicationupdate');
Route::post('upload-pds-file', 'ProfileController@upPdsFile');
Route::get('delete-pds','ProfileController@deletePds');
Route::get('delete-tor','ProfileController@deleteTor');
Route::get('delete-elig','ProfileController@deleteElig');
Route::get('delete-doc','ProfileController@deleteDoc');

Route::get('delete-wes','ProfileController@deleteWes');
Route::get('delete-tc','ProfileController@deleteTc');
Route::get('delete-coe','ProfileController@deleteCoe');
Route::get('delete-ipcr','ProfileController@deleteIpcr');
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});


