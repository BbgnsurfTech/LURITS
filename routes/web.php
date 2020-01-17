<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Records Managements
    Route::resource('records-managements', 'RecordsManagementController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Student Admissions
    Route::delete('student-admissions/destroy', 'StudentAdmissionController@massDestroy')->name('student-admissions.massDestroy');
    Route::post('student-admissions/media', 'StudentAdmissionController@storeMedia')->name('student-admissions.storeMedia');
    Route::post('student-admissions/ckmedia', 'StudentAdmissionController@storeCKEditorImages')->name('student-admissions.storeCKEditorImages');
    Route::resource('student-admissions', 'StudentAdmissionController');

    // Attendances
    Route::delete('attendances/destroy', 'AttendanceController@massDestroy')->name('attendances.massDestroy');
    Route::resource('attendances', 'AttendanceController');

    // Teachers
    Route::delete('teachers/destroy', 'TeachersController@massDestroy')->name('teachers.massDestroy');
    Route::resource('teachers', 'TeachersController');

    // Teacher Attendances
    Route::delete('teacher-attendances/destroy', 'TeacherAttendanceController@massDestroy')->name('teacher-attendances.massDestroy');
    Route::resource('teacher-attendances', 'TeacherAttendanceController');

    // Class Time Tables
    Route::resource('class-time-tables', 'ClassTimeTableController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Parent Guardianregisters
    Route::delete('parent-guardianregisters/destroy', 'ParentGuardianregisterController@massDestroy')->name('parent-guardianregisters.massDestroy');
    Route::resource('parent-guardianregisters', 'ParentGuardianregisterController');
});
