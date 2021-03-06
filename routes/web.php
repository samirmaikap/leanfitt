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


Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

//Route::group(['namespace' => 'Web'], function () {

// Common routes
//

Route::get('/profile', function () {
        return view('app.quiz');
});

Route::get('/awards', function () {
    return view('app.awards');
});

Route::get('/performance', function () {
    return view('app.performance');
});


//Route::get('/', function () {
////        return view('welcome');
//    dd(auth()->user());
//});
//Route::get('/dashboard', 'Web\DashboardController@index');
//Route::get('/lean-tools', function () {
//    return view('app.lean-tools.index');
//});
//Route::get('/lean-tools/{id}', function () {
//    return view('app.lean-tools.show');
//});

// Super Admin routes

Route::group(['namespace' => 'Web'], function () {

    Route::get('users', 'UserController@index');
    Route::post('users', 'UserController@store');
    Route::get('users/{id}', 'UserController@show');
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@delete');

    Route::get('departments', 'DepartmentController@index');
    Route::post('departments', 'DepartmentController@store');
    Route::get('departments/{id}', 'DepartmentController@show');
    Route::put('departments/{id}', 'DepartmentController@update');
    Route::delete('departments/{id}', 'DepartmentController@delete');

    Route::get('organizations', 'OrganizationController@index');
    Route::get('organizations/create', 'OrganizationController@create');
    Route::post('organizations/create','OrganizationController@store');
    Route::put('organizations/{organizationId}', function ($id) {
        dd('updated');
    });
    Route::delete('organizations/{organizationId}', function ($id) {
        dd('deleted');
    });
    Route::get('organizations/{organizationId}/users', function () {
        return view('app.organizations.users');
    });
    Route::get('organizations/{organizationId}/profile', function () {

    });
    Route::get('organizations/{organizationId}/subscription', function () {

    });
    Route::get('organizations/{organizationId}/settings', function () {

    });

    Route::get('lean-tools', 'LeanToolController@index');
    Route::get('lean-tools/view/{tool_id}', 'LeanToolController@show');
    Route::get('lean-tools/create', 'LeanToolController@create');
});

// User routes
Route::group(['domain' => '{organization}.leanfitt.host', 'namespace' => 'Web', 'middleware' => ['organization'] ], function () {

    Route::get('/test/{test}', function ($test) {
//        dd(auth()->user());
//        dd($test);
        dd(session()->all());

    });

    Route::get('/', function ($subdomain) {
        dd(auth()->user());
        dd($subdomain);
        $name = DB::table('users')->where('name', $subdomain)->get();
    });

    Route::get('/prefix', function () {
        dd(request()->route()->getPrefix());
    });

    Route::get('/dashboard', 'DashboardController@index');

    Route::get('users', 'UserController@index');
    Route::post('users', 'UserController@store');
    Route::get('users/{id}', 'UserController@show');
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
    Route::get('/projects/{projectId}', 'ProjectController@show');
    Route::get('/projects/{projectId}/details', 'ProjectController@show');
    Route::get('/projects/{projectId}/kpi', 'ProjectController@kpi');
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

//});