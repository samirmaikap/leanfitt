<?php

use Illuminate\Http\Request;

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

//Auth;
Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');

//Route::group(['namespace' => 'API','middleware'=>'auth:api'], function () {
Route::group(['namespace' => 'API'], function () {

    Route::post('register/organizations', 'OrganizationController@create');

    /*User Services*/
    Route::get('users', 'UserController@index');
    Route::post('users', 'UserController@create');
    Route::get('users/profile', 'UserController@profile');
    Route::get('users/list', 'UserController@list');
    Route::post('users/invitation', 'UserController@invitation');
    Route::get('users/{user_id}/invitation/resend', 'UserController@resendInvitation');
    Route::get('users/{user_id}/show', 'UserController@find');
    Route::get('users/{user_id}/organizations', 'UserController@getRelatedOrganization');
    Route::put('users/{user_id}', 'UserController@update');
    Route::delete('users/{user_id}', 'UserController@delete');
    Route::get('users/{user_id}/suspend', 'UserController@suspend');
    Route::get('users/{user_id}/restore', 'UserController@restore');

    /*Organization*/
    Route::get('organizations', 'OrganizationController@index');
    Route::get('organizations/list', 'OrganizationController@list'); /*for multi purpose dropdown*/
    Route::get('organizations/{organization_id}', 'OrganizationController@show');
    Route::put('organizations/{organization_id}', 'OrganizationController@update');
    Route::delete('organizations/{organization_id}', 'OrganizationController@delete');

    /*Departments*/
    Route::get('departments', 'DepartmentController@index'); /*filter organization*/
    Route::get('departments/list', 'DepartmentController@list'); /*for multi purpose dropdown*/
    Route::get('departments/{department_id}/show', 'DepartmentController@show');
    Route::post('departments', 'DepartmentController@create');
    Route::put('departments/{department_id}', 'DepartmentController@update');
    Route::delete('departments/{department_id}', 'DepartmentController@delete');

    /*Lean Tools*/
    Route::get('leantools', 'LeanToolsController@index');
    Route::post('leantools', 'LeanToolsController@create');
    Route::put('leantools/{tool_id}', 'LeanToolsController@update');
    Route::delete('leantools/{tool_id}', 'LeanToolsController@delete');
    Route::get('leantools/{tool_id}', 'LeanToolsController@show');

    /*Quiz*/
    Route::get('quiz', 'QuizController@index');
    Route::get('quiz/taken/list', 'QuizController@taken'); /*use filter for department and organization eg. url?department=1*/
    Route::get('quiz/{tool_id}/take', 'QuizController@show'); /*display with result, if result then display result page*/
    Route::post('quiz/post/result', 'QuizController@create');

    /*Assessment*/
    Route::get('assessment/{user_id}', 'AssessmentController@index');
    Route::get('assessment/show/new', 'AssessmentController@show');
    Route::get('assessment/taken/list', 'AssessmentController@list'); /*department and organization,user*/
    Route::post('assessment/result', 'AssessmentController@create');

    /*Action Items*/
    Route::get('items', 'ActionItemController@index'); /*use filter for department and organization eg. url?department=1&type=report*/
    Route::get('items/{item_id}/show', 'ActionItemController@show'); /*comment,images,assignee*/
    Route::post('items', 'ActionItemController@create');
    Route::put('items/{item_id}', 'ActionItemController@update');/*update any data name,due date,position,board*/

    Route::post('items/members', 'ActionItemController@addAssignee'); /*item_id*/
    Route::delete('items/members/{item_id}/{assignee_id}', 'ActionItemController@removeAssignee');

    Route::get('items/assignments/all', 'ActionItemController@getAssignment');
    Route::post('items/assignments', 'ActionItemController@addAssignment');
    Route::put('items/assignments/{assignment_id}', 'ActionItemController@updateAssignment');
    Route::delete('items/assignments/{assignment_id}', 'ActionItemController@removeAssignment');

    Route::get('items/{item_id}/archive', 'ActionItemController@archive');
    Route::get('items/{item_id}/restore', 'ActionItemController@restore');
    Route::delete('items/{item_id}/delete', 'ActionItemController@delete');

    /*Comment*/
    Route::post('comments', 'CommentController@create'); /*item_id*/
    Route::put('comments/{comment_id}', 'CommentController@update');
    Route::delete('comments/{comment_id}', 'CommentController@delete');

    /*Attachment*/
    Route::post('attachments', 'AttachmentController@create'); /*item_id*/
    Route::delete('attachments/{attachment_id}', 'AttachmentController@delete');

    /*Project*/
    Route::get('projects', 'ProjectController@index'); /*filter by organization*/
    Route::get('projects/{project_id}', 'ProjectController@show');
    Route::post('projects', 'ProjectController@create');
    Route::put('projects/{project_id}', 'ProjectController@update');

    Route::get('projects/{project_id}/archive', 'ProjectController@archive');
    Route::get('projects/{project_id}/restore', 'ProjectController@restore');
    Route::get('projects/{project_id}/complete', 'ProjectController@complete');
    Route::delete('projects/{project_id}', 'ProjectController@delete');

    /*Kpi*/
    Route::get('kpi', 'KpiController@index'); /*filter by organization,project*/
    Route::get('kpi/{kpi_id}', 'KpiController@show');
    Route::post('kpi', 'KpiController@create');
    Route::put('kpi/{kpi_id}', 'KpiController@update');
    Route::delete('kpi/{kpi_id}', 'KpiController@delete');

    Route::post('kpi/data', 'KpiController@addDataPoint');
    Route::post('kpi/data/filter', 'KpiController@filterDataPoint'); /*kpi_id,start_date,end_date*/
    Route::delete('kpi/data/{point_id}', 'KpiController@deleteDataPoint');

    /*Award*/
    Route::get('awards', 'AwardController@index'); /*department,organization,user_id*/

    /*Report*/
    Route::get('reports', 'ReportController@index'); /*all reports filterable organization projects*/
    Route::get('reports/names', 'ReportController@names'); /*all the report name*/
    Route::get('reports/{report_id}/show', 'ReportController@show'); /*get the report*/
    Route::post('reports', 'ReportController@create'); /*get the report*/
    Route::delete('reports/{report_id}/delete', 'ReportController@delete'); /*get the report*/

    Route::get('reports/{report_id}/grid', 'ReportController@showGridData'); /*display all the grid data*/
    Route::post('reports/grid', 'ReportController@createGridData'); /*new grid data*/
    Route::delete('reports/grid/{grid_id}', 'ReportController@deleteGridData'); /*Delete a grid data*/

    Route::get('reports/{report_id}/chart', 'ReportController@showChartData');
    Route::post('reports/chart', 'ReportController@createChartData');
    Route::delete('reports/chart/{chart_id}', 'ReportController@deleteChartData');
    Route::post('reports/chart/axis', 'ReportController@changeChartAxis');

    Route::get('reports/{report_id}/default/{level}', 'ReportController@showDefaultData'); /*filter using type*/
    Route::get('reports/{report_id}/{default_id}/element', 'ReportController@showDefaultElementData'); /*filter using sort*/
    Route::post('reports/default', 'ReportController@createDefaultData');
    Route::post('reports/element', 'ReportController@createDefaultElementData');
    Route::delete('reports/default/{default_id}', 'ReportController@deleteDefaultData');
    Route::delete('reports/element/{element_id}', 'ReportController@deleteDefaultElementData');
    Route::get('reports/{report_id}/default/assignments/{level}', 'ReportController@showDefaultAssignments');
    Route::get('reports/{default_id}/element/assignments/{level}', 'ReportController@showElementAssignments');
    Route::post('reports/default/assignments', 'ReportController@createDefaultAssignments');
    Route::post('reports/element/assignments', 'ReportController@createElementAssignments');
    Route::delete('reports/default/assignments/{assignment_id}', 'ReportController@deleteDefaultAssignments');
    Route::delete('reports/element/assignments/{assignment_id}', 'ReportController@deleteElementAssignments');

    Route::get('reports/{report_id}/problem', 'ReportController@showFive');
    Route::post('reports/problem', 'ReportController@createFive');
    Route::post('reports/reason', 'ReportController@createFiveWhy');
    Route::delete('reports/problem/{problem_id}', 'ReportController@deleteFive');
    Route::delete('reports/reason/{reason_id}', 'ReportController@deleteFiveWhy');
});

Route::get('test', function (){
    return auth()->user()->id;
});
