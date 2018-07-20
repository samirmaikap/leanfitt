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


// Common routes
Route::get('/', function () {
        return view('landing');
});
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');


// SuperAdmin routes
Route::group(['namespace' => 'Web', 'middleware' => 'auth:web'], function () {

    Route::get('organizations', 'OrganizationController@index');
    Route::get('organizations/create', 'OrganizationController@create');
    Route::post('organizations/create','OrganizationController@store');
    Route::put('organizations/{organizationId}', function ($id) {
        dd('updated');
    });
    Route::delete('organizations/{organizationId}', function ($id) {
        dd('deleted');
    });

});


// User routes
Route::group(['domain' => '{organization}' . config('session.domain'), 'namespace' => 'Web', 'middleware' => 'checkDomain'], function () {

    Route::get('/dashboard', 'DashboardController@index');

    Route::get('users', 'UserController@index');
    Route::post('users', 'UserController@store');
    Route::post('users/invitation', 'UserController@invitation');
    Route::get('users/{id}', 'UserController@show');
    Route::get('users/{id}/profile', 'UserController@profile');
    Route::get('users/{user_id}/suspend', 'UserController@suspend');
    Route::get('users/{user_id}/restore', 'UserController@restore');
    Route::get('users/{id}/invitation/resend', 'UserController@reInvitation');
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@delete');


    Route::get('departments', 'DepartmentController@index');
    Route::post('departments', 'DepartmentController@store');
    Route::get('departments/{id}', 'DepartmentController@show');
    Route::put('departments/{id}', 'DepartmentController@update');
    Route::delete('departments/{id}', 'DepartmentController@delete');

    Route::get('roles', 'RoleController@index');
    Route::post('roles', 'RoleController@store');
    Route::get('roles/{id}', 'RoleController@show');
    Route::put('roles/{id}', 'RoleController@update');
    Route::delete('roles/{id}', 'RoleController@delete');

    Route::get('/action-items/board', function () {
        return view('app.action-items.board');
    });

    Route::get('/projects', 'ProjectController@index');
    Route::post('/projects', 'ProjectController@create');
    Route::get('/projects/{project_id}', 'ProjectController@show');
    Route::get('/projects/{project_id}/details', 'ProjectController@show');
    Route::get('/projects/{project_id}/kpi', 'ProjectController@kpi');
    Route::get('/projects/{projectId}/members', 'ProjectController@members');
    Route::get('/projects/{projectId}/action-items', 'ProjectController@actionItems');
    Route::get('/projects/{projectId}/reports', 'ProjectController@reports');

    Route::get('/kpi', 'KpiController@index');
    Route::post('/kpi', 'KpiController@create');
    Route::post('/kpi/{kpiId}/data', 'KpiController@addDataPoint');

    Route::get('lean-tools', 'LeanToolController@index');
    Route::get('lean-tools/view/{tool_id}', 'LeanToolController@show');
    Route::get('lean-tools/create', 'LeanToolController@create');
    Route::post('lean-tools/create', 'LeanToolController@save');
    Route::get('lean-tools/edit/{tool_id}', 'LeanToolController@create');

    Route::get('quizzes', 'QuizController@index');
    Route::get('quizzes/take/{tool_id}', 'QuizController@show');
    Route::post('quizzes/post', 'QuizController@create');

    Route::get('assessment', 'AssessmentController@index');
    Route::get('assessment/take', 'AssessmentController@show');
    Route::post('assessment/take', 'AssessmentController@create');

    Route::get('awards', 'AwardController@index');
});

Route::group(['namespace' => 'Web'], function () {

    Route::get('/dashboard', 'DashboardController@index');
    Route::get('organizations/create', 'OrganizationController@create');
    Route::post('organizations/create','OrganizationController@store');
    Route::get('organizations/{organization_id}/view','OrganizationController@show');

});