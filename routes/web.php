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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::Resource('usergroup','UserGroupController');
Route::Resource('profile','ProfileController');
Route::Resource('course','CourseController');
Route::Resource('users','UsersController');
Route::Resource('lesson','LessonController');
Route::Resource('organization','OrganizationController');
Route::Resource('package','PackageController');
Route::get('/home', 'HomeController@index')->name('home');


Route::get('lesson/create/{id}', 'LessonController@createLesson');

 // Show Modal
Route::get('users/showUsersModal/{id}', 'UsersController@showUsersModal');
Route::get('course/showCourseModal/{id}', 'CourseController@showCourseModal');
Route::get('package/showPackageModal/{id}', 'PackageController@showPackageModal');
Route::get('usergroup/showUsergroupModal/{id}', 'UserGroupController@showUsergroupModal');

// list users
Route::get('users/getUsersList/{id}', 'UsersController@getUsersList');

 // UserGroup-Organization
Route::get('organization/create/{id}', 'OrganizationController@createOrganization');
Route::get('organization/editOrganization/{id}','OrganizationController@editOrganization');

//Route::post('/addorganization', 'OrganizationController@store');

Route::post('organization/{id}','OrganizationController@update');
Route::get('organization/destroy/{id}/{var}','OrganizationController@destroy');
