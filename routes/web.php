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
Route::get('recovery', 'Web\AuthController@recovery');
Route::post('recovery', 'Web\AuthController@checkRecovery');
Route::get('password/change', 'Web\AuthController@changePassword');
Route::post('password/change', 'Web\AuthController@updatePassword');
Route::get('invitaion/accept', 'Web\AuthController@invitation');

Route::get('test', function(){
     dd(\App\Models\ProjectMember::where('id',1)->with('user')->first());
});

Route::view('abort/suspend', 'errors.suspend');
Route::view('abort/invited', 'errors.invited');
Route::view('abort/subscription', 'errors.subscription');

Route::get('projects/{project_id}/reports/{report_id}', 'Web\ReportController@view');
Route::get('users/{id}/profile', 'Web\UserController@profile');

Route::get('dashboard/export/pdf', 'Web\DashboardController@makePdf');

Route::get('evaluations', 'Web\UserController@allEvaluations');

// User routes
Route::group(['domain' => '{organization}' . config('session.domain'), 'namespace' => 'Web'], function () {
    Route::group(['middleware' => ['checkDomain','hasAccess','auth:web']], function() {
        Route::get('/dashboard', 'DashboardController@index');

        Route::get('users', 'UserController@index');
        Route::post('users', 'UserController@store');
        Route::post('users/invitation', 'UserController@invitation');
        Route::get('users/{id}', 'UserController@show');
        Route::get('users/{user_id}/suspend', 'UserController@suspend');
        Route::get('users/{user_id}/restore', 'UserController@restore');
        Route::get('users/{id}/invitation/resend', 'UserController@reInvitation');
        Route::put('users/{id}', 'UserController@update');
        Route::delete('users/{id}', 'UserController@delete');

        Route::post('users/profile/evaluation', 'UserController@evaluation');

        Route::get('organizations/{organization_id}/view','OrganizationController@show');
        Route::get('organizations/create', 'OrganizationController@create');
        Route::post('organizations/create','OrganizationController@store');
        Route::get('organizations/subscription/revoke','OrganizationController@cancelSubscription');
        Route::get('organizations/subscription/resume','OrganizationController@resumeSubscription');
        Route::put('organizations/{organization_id}','OrganizationController@update');

        Route::post('organizations/add/subscription','OrganizationController@addSubscription');

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

        Route::get('/projects', 'ProjectController@index');
        Route::post('/projects', 'ProjectController@create');
        Route::get('/projects/{project_id}', 'ProjectController@show');
        Route::get('/projects/{project_id}/details', 'ProjectController@show');
        Route::get('/projects/{project_id}/kpi', 'ProjectController@kpi');
        Route::get('/projects/{projectId}/members', 'ProjectController@members');
        Route::get('/projects/{projectId}/action-items', 'ProjectController@actionItems');
        Route::get('/projects/{project_id}/reports', 'ProjectController@reports');

        Route::put('/projects/{project_id}', 'ProjectController@update');
        Route::put('/projects/{project_id}/complete', 'ProjectController@complete');
        Route::put('/projects/{project_id}/archive', 'ProjectController@archive');
        Route::put('/projects/{project_id}/delete', 'ProjectController@delete');

        Route::post('/projects/reports', 'ReportController@create');

        Route::post('/projects/{project_id}/savings/tangibles', 'ProjectController@saveTangibles');
        Route::post('/projects/{project_id}/savings/intangibles', 'ProjectController@saveIntangibles');

        Route::post('/projects/reports/charts', 'ReportController@storeChartData');
//    Route::put('/projects/reports/charts/{chart_id}', 'ReportController@updateChartData');
        Route::delete('/projects/reports/charts/{chart_id}', 'ReportController@removeChartData');
        Route::post('/projects/reports/{report_id}/charts/axis', 'ReportController@changeChartAxis');

        Route::post('projects/member', 'ProjectController@addMember');
        Route::delete('projects/{project_id}/member/{member_id}/remove', 'ProjectController@removeMember');

        Route::post('projects/attachment', 'ProjectController@addAttachment');
        Route::delete('projects/{project_id}/attachment/{attachment_id}/remove', 'ProjectController@removeAttachment');

        Route::post('projects/comment', 'ProjectController@addComment');
        Route::delete('projects/comment/{comment_id}/remove', 'ProjectController@removeComment');

        Route::get('/action-items', 'ActionItemController@index');
        Route::post('/action-items', 'ActionItemController@create');
        Route::put('/action-items/{id}', 'ActionItemController@update');

        Route::get('/kpi', 'KpiController@index');
        Route::post('/kpi', 'KpiController@create');
        Route::put('/kpi/{id}', 'KpiController@update');
        Route::post('/kpi/{kpiId}/data', 'KpiController@addDataPoint');
        Route::put('/kpi/{kpiId}/data/{datId}', 'KpiController@updateDataPoint');
        Route::delete('/kpi/{kpiId}/data/{datId}', 'KpiController@deleteDataPoint');

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

});

Route::group(['namespace' => 'Web','middleware'=>'auth:web'], function () {

    Route::get('/dashboard', 'DashboardController@index');

    Route::get('organizations', 'OrganizationController@index');
    Route::get('organizations/{organization_id}/view','OrganizationController@show');
    Route::get('organizations/create', 'OrganizationController@create');
    Route::post('organizations/create','OrganizationController@store');
    Route::post('organizations/create/custom','OrganizationController@customOrganization');
    Route::delete('organizations/{organization_id}','OrganizationController@deleteOrganization');
    Route::post('organizations/add/subscription','OrganizationController@addSubscription');
    Route::put('organizations/{organization_id}','OrganizationController@update');

    Route::get('users', 'UserController@index');
    Route::put('users/{id}', 'UserController@update');

    Route::get('/projects', 'ProjectController@index');
    Route::get('/projects/{project_id}/kpi', 'ProjectController@kpi');
    Route::get('/projects/{projectId}/members', 'ProjectController@members');
    Route::get('/projects/{projectId}/action-items', 'ProjectController@actionItems');
    Route::get('/projects/{projectId}/reports', 'ProjectController@reports');
    Route::get('/projects/{project_id}/details', 'ProjectController@show');

    Route::get('lean-tools', 'LeanToolController@index');
    Route::get('lean-tools/view/{tool_id}', 'LeanToolController@show');
    Route::get('lean-tools/create', 'LeanToolController@create');
    Route::post('lean-tools/create', 'LeanToolController@save');
    Route::get('lean-tools/edit/{tool_id}', 'LeanToolController@create');

    Route::get('quizzes', 'QuizController@index');

    Route::get('assessment', 'AssessmentController@index');

    Route::get('awards', 'AwardController@index');

    Route::post('settings/intangibles', 'SettingsController@intangibles');
});

Route::get('/support', function (){

    $html = "<html>
    <head>
    <style>
    #atlwdg-trigger{
    top: 45%!important;
    }
</style>
</head>
    <body>
        <h1 style='text-align: center;margin-top: 200px;'>Found an issue ? Help up make LeanFITT&trade; better!</h1>
       <script type=\"text/javascript\" src=\"https://astakyuta.atlassian.net/s/d41d8cd98f00b204e9800998ecf8427e-T/-nuco74/b/0/a44af77267a987a660377e5c46e0fb64/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=f07a7413\"></script>
    </body>
</html>";

    return $html;
});
