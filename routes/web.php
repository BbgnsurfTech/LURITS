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
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::post('teams/parse-csv-import', 'TeamController@parseCsvImport')->name('teams.parseCsvImport');
    Route::post('teams/process-csv-import', 'TeamController@processCsvImport')->name('teams.processCsvImport');
    Route::resource('teams', 'TeamController');

    // Records Managements
    Route::resource('records-managements', 'RecordsManagementController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Student Admissions
    Route::delete('student-admissions/destroy', 'StudentAdmissionController@massDestroy')->name('student-admissions.massDestroy');
    Route::post('student-admissions/media', 'StudentAdmissionController@storeMedia')->name('student-admissions.storeMedia');
    Route::post('student-admissions/ckmedia', 'StudentAdmissionController@storeCKEditorImages')->name('student-admissions.storeCKEditorImages');
    Route::post('student-admissions/parse-csv-import', 'StudentAdmissionController@parseCsvImport')->name('student-admissions.parseCsvImport');
    Route::post('student-admissions/process-csv-import', 'StudentAdmissionController@processCsvImport')->name('student-admissions.processCsvImport');
    Route::resource('student-admissions', 'StudentAdmissionController');

    // Attendances
    Route::delete('attendances/destroy', 'AttendanceController@massDestroy')->name('attendances.massDestroy');
    Route::post('attendances/parse-csv-import', 'AttendanceController@parseCsvImport')->name('attendances.parseCsvImport');
    Route::post('attendances/process-csv-import', 'AttendanceController@processCsvImport')->name('attendances.processCsvImport');
    Route::resource('attendances', 'AttendanceController');

    // Teachers
    Route::delete('teachers/destroy', 'TeachersController@massDestroy')->name('teachers.massDestroy');
    Route::post('teachers/parse-csv-import', 'TeachersController@parseCsvImport')->name('teachers.parseCsvImport');
    Route::post('teachers/process-csv-import', 'TeachersController@processCsvImport')->name('teachers.processCsvImport');
    Route::resource('teachers', 'TeachersController');

    // Teacher Attendances
    Route::delete('teacher-attendances/destroy', 'TeacherAttendanceController@massDestroy')->name('teacher-attendances.massDestroy');
    Route::post('teacher-attendances/parse-csv-import', 'TeacherAttendanceController@parseCsvImport')->name('teacher-attendances.parseCsvImport');
    Route::post('teacher-attendances/process-csv-import', 'TeacherAttendanceController@processCsvImport')->name('teacher-attendances.processCsvImport');
    Route::resource('teacher-attendances', 'TeacherAttendanceController');

    // Class Time Tables
    Route::resource('class-time-tables', 'ClassTimeTableController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Parent Guardianregisters
    Route::delete('parent-guardianregisters/destroy', 'ParentGuardianregisterController@massDestroy')->name('parent-guardianregisters.massDestroy');
    Route::post('parent-guardianregisters/parse-csv-import', 'ParentGuardianregisterController@parseCsvImport')->name('parent-guardianregisters.parseCsvImport');
    Route::post('parent-guardianregisters/process-csv-import', 'ParentGuardianregisterController@processCsvImport')->name('parent-guardianregisters.processCsvImport');
    Route::resource('parent-guardianregisters', 'ParentGuardianregisterController');

    // Task Statuses
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tags
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Tasks
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendars
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Asset Categories
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Locations
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Statuses
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Assets
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets Histories
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Contact Companies
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::resource('contact-contacts', 'ContactContactsController');

    // Expense Categories
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Categories
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expenses
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Incomes
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Expense Reports
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Content Categories
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tags
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Pages
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
