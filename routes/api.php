<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Teams
    Route::apiResource('teams', 'TeamApiController');

    // Student Admissions
    Route::post('student-admissions/media', 'StudentAdmissionApiController@storeMedia')->name('student-admissions.storeMedia');
    Route::apiResource('student-admissions', 'StudentAdmissionApiController');

    // Attendances
    Route::apiResource('attendances', 'AttendanceApiController');

    // Teachers
    Route::apiResource('teachers', 'TeachersApiController');

    // Teacher Attendances
    Route::apiResource('teacher-attendances', 'TeacherAttendanceApiController');

    // Parent Guardianregisters
    Route::apiResource('parent-guardianregisters', 'ParentGuardianregisterApiController');
});
