<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Routes;

Route::get('v1/data', 'Api\V1\AuthController@data');
Route::post('v1/data2', 'Api\V1\AuthController@data2');
Route::get('v1/data3', 'Api\V1\AuthController@data3');
Route::get('v1/data4', 'Api\V1\AuthController@data4');
Route::post('v1/data', 'Api\V1\AuthController@data');


//Route::post('login', 'Auth\AuthController@login');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Auth'], function 
    () {
Route::post('login', 'AuthController@login');
// Route::post('login', 'LoginController@login');
Route::post('refresh', 'LoginController@refresh');
Route::post('logout', 'LoginController@logout');
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Auth',  'middleware' => ['auth:api']], function 
    () {
    // GetLoginUser
    Route::post('getloginuser', 'LoginController@getLoginUserData');
});
// Route::post('login', 'Api\V1\Auth\AuthController@login');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    //Data Downloads
    Route::get('data-download/roles', 'DataApiController@roles');
    Route::get('data-download/permissions', 'DataApiController@permissions');
    Route::get('data-download/users', 'DataApiController@users');
    Route::get('data-download/parameters', 'DataApiController@parameters');
    Route::get('data-download/asset-management', 'DataApiController@assetManagement');
    Route::get('data-download/expense-management', 'DataApiController@expenseManagement');
    Route::get('data-download/parents', 'DataApiController@parents');
    Route::get('data-download/incidence', 'DataApiController@incidence');
    Route::get('data-download/classrooms', 'DataApiController@incidence');

    //Testing
    Route::post('stud', 'AuthController@stud');

    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Teams
    Route::apiResource('schools', 'SchoolApiController');

    // Student Admissions
    Route::post('student-admissions/media', 'StudentAdmissionApiController@storeMedia')->name('student-admissions.storeMedia');
    Route::apiResource('student-admissions', 'StudentAdmissionApiController');

    //Student Transfer
    Route::apiResource('student-transfer', 'TransferApiController');

    //Student Promotion
    Route::apiResource('student-promotion', 'PromotionApiController');

    // Subjects
    Route::apiResource('subjects', 'SubjectsApiController');

    // Classroom
    Route::apiResource('classrooms', 'ClassroomApiController');

    // Classes
    Route::apiResource('classes', 'ClassApiController');

    // Attendances
    Route::apiResource('attendance', 'AttendanceApiController');

    // Staffs
    Route::apiResource('staffs', 'StaffsApiController');

    // Staff Movement Record
    Route::apiResource('smr', 'StaffMovementRecordsApiController');

    // Teacher Attendances
    Route::apiResource('teacher-attendances', 'TeacherAttendanceApiController');

    // Parent Guardianregisters
    Route::apiResource('parents', 'ParentsApiController');

    // Incidence
    Route::apiResource('incidence', 'IncidenceApiController');

    // Task Statuses
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tags
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Tasks
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Asset Categories
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Locations
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Asset Statuses
    Route::apiResource('asset-statuses', 'AssetStatusApiController');

    // Assets
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Contact Companies
    Route::apiResource('contact-companies', 'ContactCompanyApiController');

    // Contact Contacts
    Route::apiResource('contact-contacts', 'ContactContactsApiController');

    // Expense Categories
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Income Categories
    Route::apiResource('income-categories', 'IncomeCategoryApiController');

    // Expenses
    Route::apiResource('expenses', 'ExpenseApiController');

    // Leave
    Route::apiResource('leave', 'LeaveApiController');

    // Incomes
    Route::apiResource('incomes', 'IncomeApiController');

    // Content Categories
    Route::apiResource('content-categories', 'ContentCategoryApiController');

    // Content Tags
    Route::apiResource('content-tags', 'ContentTagApiController');

    // Content Pages
    Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
    Route::apiResource('content-pages', 'ContentPageApiController');
});
