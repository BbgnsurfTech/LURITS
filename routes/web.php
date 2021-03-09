<?php
use App\Staff;

Route::redirect('/', '/login');
// Route::get('/home', function () {
//     if (session('status')) {
//         return redirect()->route('admin.home')->with('status', session('status'));
//     }

//     return redirect()->route('admin.home');
// });

Auth::routes(
    ['register' => false]
);

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    // Hi-Speed Tech
    Route::get('/a', function(){
        return (Staff::first());
    });
    Route::get('/notifications', 'HomeController@notifications')->name('notifications');
    Route::post('/notifications', 'HomeController@route')->name('notifications');
    //Reports
    Route::get('/reports', 'ReportsController@index')->name('reports.index');
    Route::post('/reports', 'ReportsController@generate')->name('reports.generate');
    Route::get('reports/timetable', 'Staff\ReportController@timetable')->name('reports.timetable');
    Route::get('reports/staff', 'Staff\ReportController@staff')->name('reports.staff');
    //Route::get('reports/student', 'Staff\ReportController@student')->name('reports.student');
    //Route::get('reports/class', 'Staff\ReportController@class')->name('reports.class');
    //Route::get('reports/studentattendance', 'Staff\ReportController@studentattendance')->name('reports.studentattendance');
    //Route::get('reports/staffattendance', 'Staff\ReportController@staffattendance')->name('reports.staffattendance');
    Route::get('lesson/attendance', 'StaffAttendanceController@lesson')->name('lesson.attendance');
    Route::get('lesson/attendance/{id}', 'StaffAttendanceController@vLesson')->name('lesson.attendance.verify');
    Route::post('lesson/face', 'StaffAttendanceController@confirm')->name('lesson.face');

    Route::get('school-staff', 'ClassController@getTeachers')->name('schoolStaff');

    Route::resource('academicyears', 'AcademicYearController');
    Route::resource('lgas', 'LGAController');
    Route::resource('zoneslgas', 'ZoneLGAController');
    Route::resource('wards', 'WardController');
    //Route::resource('schools', 'SchoolController');
    Route::resource('schoolcategories', 'SchoolCategoryController');
    Route::resource('schooltypes', 'SchoolTypeController');
    Route::resource('classsettings', 'ClassSettingController');
    Route::resource('sections', 'SectionController');
    Route::resource('subjects', 'SubjectController');
    Route::resource('subjectsettings', 'SubjectSettingController');
    Route::resource('classschedules', 'ClassScheduleController');
    Route::get('timetable', 'TimeTableController@index')->name('timetable.index');

    Route::resource('zones', 'ZoneController');
    Route::resource('incidences', 'IncidenceController');
    Route::resource('parents', 'ParentGuardianregisterController', ['except' => ['update']]);
    Route::delete('parents/destroy', 'ParentGuardianregisterController@massDestroy')->name('parents.massDestroy');
    Route::resource('calls', 'Staff\CallController');
    Route::resource('voicecalls', 'Staff\CallController');
    Route::resource('mailbox', 'MailboxController');
    Route::resource('classes', 'ClassController');

    // Route::get('filterzones', 'FilterController@filter_zones')->name('zones.filter');
    // Route::get('filterschoolcategories', 'FilterController@filter_school_categories')->name('schoolcategories.filter');
    // Route::get('filterschooltypes', 'FilterController@filter_school_types')->name('schooltypes.filter');
    // Route::get('filterschools', 'FilterController@filter_schools')->name('schools.filter');
    // Route::get('filterlgas', 'FilterController@filter_lgas')->name('lgas.filter');
    // Route::post('filterwards', 'FilterController@filter_wards')->name('wards.filter');
    // Route::get('filterclasses', 'FilterController@filter_classes')->name('classes.filter');
    // Route::get('filterallclasses', 'FilterController@filter_all_classes')->name('allclasses.filter');
    // Route::get('filterzoneslgas', 'FilterController@filter_zones_lgas')->name('zoneslgas.filter');
    // Route::get('filtersections', 'FilterController@filter_sections')->name('sections.filter');
    Route::get('filtersubjects', 'FilterController@filter_subjects')->name('subjects.filter');
    // Route::get('filterallsubjects', 'FilterController@filter_all_subjects')->name('allsubjects.filter');

    // Route::get('filterstaff', 'FilterController@filter_staff')->name('staff.filter');
    // Route::get('filterstaffemail', 'FilterController@filter_staff_email')->name('staff.filterstaffemail');
    // Route::get('filterstaffphone', 'FilterController@filter_staff_phone')->name('staff.filterstaffphone');
    // Route::get('filtermessagetype', 'FilterController@filter_message_type')->name('staff.filtermessagetype');
    // Route::get('filtermailsmstemplate', 'FilterController@filter_mail_sms_template')->name('staff.filtermailsmstemplate');
    // Route::get('filtermailsmsbody', 'FilterController@filter_mail_sms_body')->name('staff.filtermailsmsbody');
    Route::resource('mailsmstemplates', 'Staff\MailSMSTemplateController');
    Route::resource('mailsms', 'Staff\MailSMSController');
    Route::resource('calltemplates', 'Staff\CallTemplateController');
    // Route::get('filterstaff', 'FilterController@filter_staff')->name('staff.filter');
    // Route::get('filterstaffemail', 'FilterController@filter_staff_email')->name('staff.filterstaffemail');
    // Route::get('filterstaffphone', 'FilterController@filter_staff_phone')->name('staff.filterstaffphone');
    // Route::get('filtermessagetype', 'FilterController@filter_message_type')->name('staff.filtermessagetype');
    // Route::get('filtermailsmstemplate', 'FilterController@filter_mail_sms_template')->name('staff.filtermailsmstemplate');
    // Route::get('filtermailsmsbody', 'FilterController@filter_mail_sms_body')->name('staff.filtermailsmsbody');

    Route::get('export', 'Parents\ParentsController@export')->name('parents.export');
    Route::post('import', 'Parents\ParentsController@import')->name('parents.import');

    Route::get('mailbox/{folder?}', 'MailboxController@index');
    Route::get('mailbox-create', 'MailboxController@create');
    Route::post('mailbox-create', 'MailboxController@store');
    Route::get('mailbox-show/{id}', 'MailboxController@show');
    Route::put('mailbox-toggle-important', 'MailboxController@toggleImportant');
    Route::delete('mailbox-trash', 'MailboxController@trash');
    Route::get('mailbox-reply/{id}', 'MailboxController@getReply');
    Route::post('mailbox-reply/{id}', 'MailboxController@postReply');
    Route::get('mailbox-forward/{id}', 'MailboxController@getForward');
    Route::post('mailbox-forward/{id}', 'MailboxController@postForward');
    Route::get('mailbox-send/{id}', 'MailboxController@send');
    // Hi-Speed Tech


    //BBGN Surf Tech
    Route::get('/', 'HomeController@index')->name('home');
    
    // Records Managements
    Route::resource('records-managements', 'RecordsManagementController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    Route::delete('result/destroy', 'ResultController@massDestroy')->name('result.massDestroy');
    Route::post('result/parse-csv-import', 'ResultController@parseCsvImport')->name('result.parseCsvImport');
    Route::post('result/process-csv-import', 'ResultController@processCsvImport')->name('result.processCsvImport');
    Route::resource('result', 'ResultController');

    // Ibrahim Hamisu -> created Health record
    Route::delete('health/destroy', 'HealthController@massDestroy')->name('health.massDestroy');
    Route::post('health/parse-csv-import', 'HealthController@parseCsvImport')->name('health.parseCsvImport');
    Route::post('health/process-csv-import', 'HealthController@processCsvImport')->name('health.processCsvImport');
    Route::resource('health', 'HealthController');
    Route::delete('punishment/destroy', 'PunishmentController@massDestroy')->name('punishment.massDestroy');
    Route::post('punishment/parse-csv-import', 'PunishmentController@parseCsvImport')->name('punishment.parseCsvImport');
    Route::post('punishment/process-csv-import', 'PunishmentController@processCsvImport')->name('punishment.processCsvImport');
    Route::resource('punishment', 'PunishmentController');

    // Ibrahim Hamisu -> created visitors record
    Route::delete('visitors/destroy', 'VisitorsController@massDestroy')->name('visitors.massDestroy');
    Route::post('visitors/parse-csv-import', 'VisitorsController@parseCsvImport')->name('visitors.parseCsvImport');
    Route::post('visitors/process-csv-import', 'VisitorsController@processCsvImport')->name('visitors.processCsvImport');
    Route::resource('visitors', 'VisitorsController');
    // Ibrahim Hamisu -> created staff displ record
    Route::delete('sdb/destroy', 'SdbController@massDestroy')->name('sdb.massDestroy');
    Route::post('sdb/parse-csv-import', 'SdbController@parseCsvImport')->name('sdb.parseCsvImport');
    Route::post('sdb/process-csv-import', 'SdbController@processCsvImport')->name('sdb.processCsvImport');
    Route::resource('sdb', 'SdbController');
    //Ibrahim Hamisu -> created log book
    Route::delete('log-book/destroy', 'LogBookController@massDestroy')->name('log-book.massDestroy');
    Route::post('log-book/parse-csv-import', 'LogBookController@parseCsvImport')->name('log-book.parseCsvImport');
    Route::post('log-book/process-csv-import', 'LogBookController@processCsvImport')->name('log-book.processCsvImport');
    Route::resource('log-book', 'LogBookController');
    //Ibrahim Hamisu -> School leaving certificate
    Route::delete('lcr/destroy', 'LcrController@massDestroy')->name('lcr.massDestroy');
    Route::post('lcr/parse-csv-import', 'LcrController@parseCsvImport')->name('lcr.parseCsvImport');
    Route::post('lcr/process-csv-import', 'LcrController@processCsvImport')->name('lcr.processCsvImport');
    Route::resource('lcr', 'LcrController');
    //Ibrahim Hamisu -> Assignment record
    Route::delete('assignment/destroy', 'AssignmentController@massDestroy')->name('assignment.massDestroy');
    Route::post('assignment/parse-csv-import', 'AssignmentController@parseCsvImport')->name('assignment.parseCsvImport');
    Route::post('assignment/process-csv-import', 'AssignmentController@processCsvImport')->name('assignment.processCsvImport');
    Route::resource('assignment', 'AssignmentController');
    //Ibrahim Hamisu -> Clubs activities
    Route::delete('clubs/destroy', 'ClubsController@massDestroy')->name('clubs.massDestroy');
    Route::post('clubs/parse-csv-import', 'ClubsController@parseCsvImport')->name('clubs.parseCsvImport');
    Route::post('clubs/process-csv-import', 'ClubsController@processCsvImport')->name('clubs.processCsvImport');
    Route::resource('clubs', 'ClubsController');
    //Ibrahim Hamisu -> Postal
    Route::delete('postal/destroy', 'PostalController@massDestroy')->name('postal.massDestroy');
    Route::post('postal/parse-csv-import', 'PostalController@parseCsvImport')->name('postal.parseCsvImport');
    Route::post('postal/process-csv-import', 'PostalController@processCsvImport')->name('postal.processCsvImport');
    Route::resource('postal', 'PostalController');
    //Ibrahim Hamisu -> Complaints
    Route::delete('complaint/destroy', 'ComplaintController@massDestroy')->name('complaint.massDestroy');
    Route::post('complaint/parse-csv-import', 'ComplaintController@parseCsvImport')->name('complaint.parseCsvImport');
    Route::post('complaint/process-csv-import', 'ComplaintController@processCsvImport')->name('complaint.processCsvImport');
    Route::resource('complaint', 'ComplaintController');

    // Task Statuses
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::post('task-statuses/parse-csv-import', 'TaskStatusController@parseCsvImport')->name('task-statuses.parseCsvImport');
    Route::post('task-statuses/process-csv-import', 'TaskStatusController@processCsvImport')->name('task-statuses.processCsvImport');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tags
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Tasks
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::post('tasks/parse-csv-import', 'TaskController@parseCsvImport')->name('tasks.parseCsvImport');
    Route::post('tasks/process-csv-import', 'TaskController@processCsvImport')->name('tasks.processCsvImport');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendars
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Asset Locations
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Contact Companies
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::post('contact-companies/parse-csv-import', 'ContactCompanyController@parseCsvImport')->name('contact-companies.parseCsvImport');
    Route::post('contact-companies/process-csv-import', 'ContactCompanyController@processCsvImport')->name('contact-companies.processCsvImport');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::post('contact-contacts/parse-csv-import', 'ContactContactsController@parseCsvImport')->name('contact-contacts.parseCsvImport');
    Route::post('contact-contacts/process-csv-import', 'ContactContactsController@processCsvImport')->name('contact-contacts.processCsvImport');
    Route::resource('contact-contacts', 'ContactContactsController');

    // Content Pages
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::post('content-pages/parse-csv-import', 'ContentPageController@parseCsvImport')->name('content-pages.parseCsvImport');
    Route::post('content-pages/process-csv-import', 'ContentPageController@processCsvImport')->name('content-pages.processCsvImport');
    Route::resource('content-pages', 'ContentPageController');

    Route::resource('promotion', 'PromotionController');
    Route::post('promotion/individual', 'PromotionController@individual')->name('promotion.individual');
    Route::get('promotion-get', 'PromotionController@getAdmission')->name('promotion.get');

    Route::resource('school-classes', 'SchoolClassesController');
    Route::delete('school-classes/destroy', 'SchoolClassesController@massDestroy')->name('school-classes.massDestroy');

    Route::get('user-school', 'UsersController@user')->name('user');
    Route::post('user-school', 'UsersController@storeUser')->name('user.store');   

    //Not Admin Routes
    Route::get('get-assets', 'AssetController@notAdmin')->name('assets.getAssets');
    Route::get('get-classrooms', 'ClassroomController@getClassroom')->name('classrooms.getClassrooms');
    Route::get('get-toilets', 'ToiletController@getToilets')->name('toilets.getToilets');
    Route::get('get-seatings', 'SeatingController@getSeatings')->name('seatings.getSeatings');
    Route::get('get-expense', 'ExpenseController@getExpense')->name('expenses.getExpense');
    Route::get('get-income', 'IncomeController@getIncome')->name('incomes.getIncome');
    Route::get('get-smr', 'StaffMovementRecordController@getSmr')->name('smr.getSmr');
    Route::get('get-admission', 'StudentAttendanceController@getAdmission')->name('student-admissions.getAdmission');
    Route::get('get-subject', 'SubjectsController@getSubject')->name('subjects.getSubject');
    Route::get('get-staff', 'StaffsController@getStaff')->name('staffs.getStaff');
    Route::get('get-transfer', 'TransferController@getTransfer')->name('transfer.getTransfer');
    //Not Admin Routes

    Route::get('session', 'SessionTermController@index')->name('session.index');
    Route::post('session', 'SessionTermController@store')->name('session.store');
    Route::put('session', 'SessionTermController@update')->name('session.update');
    Route::post('term', 'SessionTermController@storeTerm')->name('term.store');
    Route::put('session/term', 'SessionTermController@updateTerm')->name('term.update');
    Route::put('session/edit/{id}', 'SessionTermController@editSession')->name('session.edit');
    Route::put('term/edit/{id}', 'SessionTermController@editTerm')->name('term.edit');
    Route::delete('term/delete/{id}', 'SessionTermController@deleteTerm')->name('term.delete');
    Route::delete('session/delete/{id}', 'SessionTermController@deleteSession')->name('session.delete');

    Route::delete('assets/remove/{id}', 'AssetController@remove');
    //LGA
    Route::resource('nomenclatures', 'NomenclatureController');
    Route::get('lga/fetchStates/{country}', 'FiltersController@fetchStates')->name('lga.fetchStates');
    Route::get('lga/fetchZones/{zone}', 'FiltersController@fetchZones')->name('lga.fetchZones');
    Route::get('lga/fetchLgas/{state}', 'FiltersController@fetchLgas')->name('lga.fetchLgas');
    Route::get('lga/fetchSectors', 'FiltersController@fetchSectors')->name('lga.fetchSectors');
    Route::get('lga/fetchSchools', 'FiltersController@fetchSchools')->name('lga.fetchSchools');
    Route::get('lga/getSchools', 'FiltersController@getSchools')->name('lga.getSchools');
    Route::get('lga/fetchClasss/{classs}', 'FiltersController@fetchClasss')->name('lga.fetchClasss');
    Route::get('lga/fetchStudent/{classs}', 'FiltersController@fetchStudent');
    Route::get('lga/fetchSectorClasses/{school}', 'FiltersController@fetchSectorClasses');
    Route::get('staffs/fetchData', 'StaffsController@fetchData')->name('staffs.fetchData');
    Route::get('staffs/fetchSector/{sector}', 'StaffsController@fetchSector');

    // Route::get('lga', 'SchoolLgasController@index');
    // Route::get('lga/fetchStates/{country}', 'SchoolLgasController@fetchStates')->name('lga.fetchStates');
    // Route::get('lga/fetchLgas/{state}', 'SchoolLgasController@fetchLgas')->name('lga.fetchLgas');

    //Copied
    Route::get('att', 'StudentAttendanceController@index');
    Route::get('att/get/{school}/{id}', 'StudentAttendanceController@get')->name('att.get');
    Route::get('attt/get/{id}/', 'StudentAttendanceController@gett')->name('att.get');
    Route::get('t-att/get', 'StaffAttendanceController@gett')->name('t-att.get');
    Route::get('t-att/get/{id}', 'StaffAttendanceController@get')->name('t-att.get');
    Route::get('t-att/verify/{id}', 'StaffAttendanceController@verify')->name('t-att.verify');
    Route::post('att/get', 'StudentAttendanceController@save')->name('att.get.save');
    Route::post('att/get/save', 'StaffAttendanceController@save')->name('t-att.get.save');
    Route::match(['get', 'post'], 'attendances', 'StudentAttendanceController@student_attendance')->name('student_attendance.create');
    Route::post('attendances/save', 'StudentAttendanceController@student_attendance_save')->name('student_attendance.create');

    //Page
    Route::get('page', 'PagesController@index');
    Route::post('page/filter','PagesController@filter');
    Route::get('page/getUsers/{id}','PagesController@getUsers');
    //Route::get('attendances/list', 'AttendanceController@create');
    //Route::get('page/getStudents/{class_id}', 'PagesController@getStudents');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');


    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Smr
    Route::delete('smr/destroy', 'StaffMovementRecordController@massDestroy')->name('smr.massDestroy');
    Route::resource('smr', 'StaffMovementRecordController');

    //Staff Transfer
    Route::resource('staff-transfer', 'StaffTransferController');
    Route::post('staff-transfer/init', 'StaffTransferController@init')->name('staff-transfer.init');
    Route::post('staff-transfer/req', 'StaffTransferController@req')->name('staff-transfer.req');
    Route::get('staff-transfer/fetchStaffs/{school}', 'StaffTransferController@getStaff');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    //Leave
    Route::delete('leave/destroy', 'LeaveController@massDestroy')->name('leave.massDestroy');
    Route::post('leave/parse-csv-import', 'LeaveController@parseCsvImport')->name('leave.parseCsvImport');
    Route::post('leave/process-csv-import', 'LeaveController@processCsvImport')->name('leave.processCsvImport');
    Route::get('leave/getLeave', 'LeaveController@getLeave')->name('leave.getLeave');
    Route::get('leave/approve/{id}', 'LeaveController@approve')->name('leave.approve');
    Route::resource('leave', 'LeaveController');

    // Schools
    Route::delete('schools/destroy', 'SchoolsController@massDestroy')->name('schools.massDestroy');
    Route::post('schools/parse-csv-import', 'SchoolsController@parseCsvImport')->name('schools.parseCsvImport');
    Route::post('schools/process-csv-import', 'SchoolsController@processCsvImport')->name('schools.processCsvImport');
    Route::get('schools/background', 'SchoolsController@background')->name('schools.background');
    Route::post('schools/background', 'SchoolsController@storeBackground')->name('schools.store-background');
    Route::get('schools/getSchools', 'SchoolsController@getSchools')->name('schools.getSchools');
    Route::resource('schools', 'SchoolsController');


    // Student Admissions
    Route::delete('student-admissions/destroy', 'StudentAdmissionController@massDestroy')->name('student-admissions.massDestroy');
    Route::post('student-admissions/media', 'StudentAdmissionController@storeMedia')->name('student-admissions.storeMedia');
    Route::post('student-admissions/ckmedia', 'StudentAdmissionController@storeCKEditorImages')->name('student-admissions.storeCKEditorImages');
    Route::post('student-admissions/parse-csv-import', 'StudentAdmissionController@parseCsvImport')->name('student-admissions.parseCsvImport');
    Route::post('student-admissions/process-csv-import', 'StudentAdmissionController@processCsvImport')->name('student-admissions.processCsvImport');
    Route::resource('student-admissions', 'StudentAdmissionController');
    Route::get('student-admissions/fetchParents/{school}', 'StudentAdmissionController@fetchParents');
    Route::get('student-admissions/fetchClass/{school}', 'StudentAdmissionController@fetchClass');
    Route::get('student-admissionss/get-admission', 'StudentAdmissionController@getAdmission')->name('student-admissions.getAdmission');

    // Transfers
    Route::delete('transfer-register/destroy', 'TransferController@massDestroy')->name('transfer.massDestroy');
    Route::post('transfer-register/media', 'TransferController@storeMedia')->name('transfer.storeMedia');
    Route::post('transfer-register/ckmedia', 'TransferController@storeCKEditorImages')->name('transfer.storeCKEditorImages');
    Route::post('transfer-register/parse-csv-import', 'TransferController@parseCsvImport')->name('transfer-register.parseCsvImport');
    Route::post('transfer-register/process-csv-import', 'TransferController@processCsvImport')->name('transfer-register.processCsvImport');
    Route::get('transfer/initialize', 'TransferController@initialize')->name('transfer.initialize');
    Route::get('transfer/request', 'TransferController@request')->name('transfer.request');
    Route::post('transfer/initialize', 'TransferController@storeInitialize')->name('transfer.initialize.store');
    Route::post('transfer/request', 'TransferController@storeRequest')->name('transfer.request.store');
    Route::resource('transfer', 'TransferController');

    // Postal
    Route::delete('postal/destroy', 'PostalController@massDestroy')->name('postal.massDestroy');
    Route::resource('postal', 'PostalController');

    // Classroom
    Route::delete('classrooms/destroy', 'ClassroomController@massDestroy')->name('classrooms.massDestroy');
    Route::post('classrooms/parse-csv-import', 'ClassroomController@parseCsvImport')->name('classroom.parseCsvImport');
    Route::post('classrooms/process-csv-import', 'ClassroomController@processCsvImport')->name('classroom.processCsvImport');
    Route::resource('classrooms', 'ClassroomController');
    Route::get('classroom/fetchData/{school}', 'ClassroomController@fetchData')->name('classroom.fetchData');

    // Toilets
    Route::delete('toilets/destroy', 'ToiletController@massDestroy')->name('toilets.massDestroy');
    Route::post('toilets/parse-csv-import', 'ToiletController@parseCsvImport')->name('toilets.parseCsvImport');
    Route::post('toilets/process-csv-import', 'ToiletController@processCsvImport')->name('toilets.processCsvImport');
    Route::resource('toilets', 'ToiletController');
    Route::get('toilets/fetchData/{school}', 'ToiletController@fetchData')->name('toilets.fetchData');

    //Seatings
    Route::delete('seatings/destroy', 'SeatingController@massDestroy')->name('seatings.massDestroy');
    Route::post('seatings/parse-csv-import', 'SeatingController@parseCsvImport')->name('seatings.parseCsvImport');
    Route::post('seatings/process-csv-import', 'SeatingController@processCsvImport')->name('seatings.processCsvImport');
    Route::resource('seatings', 'SeatingController');
    Route::get('seatings/fetchData/{school}', 'SeatingController@fetchData')->name('seatings.fetchData');

    // Textbook
    Route::delete('textbooks/destroy', 'TextbookController@massDestroy')->name('textbooks.massDestroy');
    Route::post('textbooks/parse-csv-import', 'TextbookController@parseCsvImport')->name('textbooks.parseCsvImport');
    Route::post('textbooks/process-csv-import', 'TextbookController@processCsvImport')->name('textbooks.processCsvImport');
    Route::resource('textbooks', 'TextbookController');
    Route::get('textbooks/fetchData/{school}', 'TextbookController@fetchData')->name('textbooks.fetchData');

    // Attendances
    Route::resource('attendances', 'StudentAttendanceController');

    // Staffs
    Route::delete('staffs/destroy', 'StaffsController@massDestroy')->name('staffs.massDestroy');
    Route::post('staffs/parse-csv-import', 'StaffsController@parseCsvImport')->name('staffs.parseCsvImport');
    Route::post('staffs/process-csv-import', 'StaffsController@processCsvImport')->name('staffs.processCsvImport');
    Route::post('staffs/media', 'StaffsController@storeMedia')->name('staffs.storeMedia');
    Route::post('face-verify', 'StaffsController@face')->name('face-verify');
    Route::resource('staffs', 'StaffsController');

    // Staff Attendances
    Route::delete('staff-attendances/destroy', 'StaffAttendanceController@massDestroy')->name('staff-attendances.massDestroy');
    Route::post('staff-attendances/parse-csv-import', 'StaffAttendanceController@parseCsvImport')->name('staff-attendances.parseCsvImport');
    Route::post('staff-attendances/process-csv-import', 'StaffAttendanceController@processCsvImport')->name('staff-attendances.processCsvImport');
    Route::post('face-api', 'StaffAttendanceController@face')->name('face-api');
    Route::resource('staff-attendances', 'StaffAttendanceController');

    // Asset Categories
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');
    Route::get('assetCategory/fetchData/{school}', 'AssetCategoryController@fetchData')->name('assetCategory.fetchData');

    // Asset Statuses
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');
    Route::get('asset-statuses/fetchData/{school}', 'AssetStatusController@fetchData')->name('asset-statuses.fetchData');

    // Assets
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::post('assets/parse-csv-import', 'AssetController@parseCsvImport')->name('assets.parseCsvImport');
    Route::post('assets/process-csv-import', 'AssetController@processCsvImport')->name('assets.processCsvImport');
    Route::resource('assets', 'AssetController');

    // Assets Histories
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
    Route::get('assetsHistory/fetchData/{school}', 'AssetsHistoryController@fetchData')->name('assetsHistory.fetchData');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Expense Categories
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Categories
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expenses
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::post('expenses/parse-csv-import', 'ExpenseController@parseCsvImport')->name('expenses.parseCsvImport');
    Route::post('expenses/process-csv-import', 'ExpenseController@processCsvImport')->name('expenses.processCsvImport');
    Route::resource('expenses', 'ExpenseController');

    // Incomes
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::post('incomes/parse-csv-import', 'IncomeController@parseCsvImport')->name('incomes.parseCsvImport');
    Route::post('incomes/process-csv-import', 'IncomeController@processCsvImport')->name('incomes.processCsvImport');
    Route::resource('incomes', 'IncomeController', ['except' => ['create']]);

    // Expense Reports
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Expense Reports
    Route::delete('attendance-reports/destroy', 'AttendanceReportController@massDestroy')->name('attendance-reports.massDestroy');
    Route::resource('attendance-reports', 'AttendanceReportController');

    // Content Categories
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tags
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

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
