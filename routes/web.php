<?php
// Login
Route::get('/', 'LoginController@index');
Route::post('/login', 'LoginController@login');
Route::get('/exit', 'LoginController@exit');

// Dashboard
Route::get('/home', 'HomeController@Home');

// Administrator
  // Semester
  Route::get('/administrator/semester', 'Administrator\SemesterController@Semester');
  Route::get('/administrator/semester/create', 'Administrator\SemesterController@SemesterCreate');
  Route::post('/administrator/semester/store', 'Administrator\SemesterController@SemesterStore');
  Route::get('/administrator/semester/delete', 'Administrator\SemesterController@SemesterDelete');
  // User
  Route::get('/administrator/user', 'Administrator\UserController@user');
  Route::get('/administrator/user/create', 'Administrator\UserController@userCreate');
  Route::post('/administrator/user/store', 'Administrator\UserController@userStore');
  Route::get('/administrator/user/delete', 'Administrator\UserController@userDelete');
  Route::get('/administrator/user/edit', 'Administrator\UserController@userEdit');
  // Uos
  Route::get('/administrator/uos', 'Administrator\UosController@Uos');
  Route::post('/administrator/uos/store', 'Administrator\UosController@UosStore');
  Route::get('/administrator/uos/page', 'Administrator\UosController@UosPage');
  Route::post('/administrator/uos/page/tutor/store', 'Administrator\UosController@UosPageTutorStore');
  Route::get('/administrator/uos/page/tutor/delete', 'Administrator\UosController@UosPageTutorDelete');
  Route::get('/administrator/uos/page/tutor/timesheet', 'Administrator\UosController@UosPageTutorTimeSheet');
  Route::post('/administrator/uos/page/tutor/timesheet/tutorial/store', 'Administrator\UosController@UosPageTutorTimeSheetTutorialStore');
  Route::post('/administrator/uos/page/tutor/timesheet/other/store', 'Administrator\UosController@UosPageTutorTimeSheetOtherStore');
  Route::post('/administrator/uos/page/tutorial/store', 'Administrator\UosController@UosPageTutorialStore');
  Route::get('/administrator/uos/page/tutorial/delete', 'Administrator\UosController@UosPageTutorialDelete');
  Route::post('/administrator/uos/page/coordinator/store', 'Administrator\UosController@UosPageCoordinatorStore');
  Route::get('/administrator/uos/page/coordinator/delete', 'Administrator\UosController@UosPageCoordinatorDelete');
  Route::post('/administrator/uos/page/tutorial/tutor/store', 'Administrator\UosController@UosPageTutorialTutorStore');
  // Timesheet
  Route::get('/administrator/timesheet', 'Administrator\TimesheetController@timesheet');
  Route::get('/administrator/timesheet/approve', 'Administrator\TimesheetController@timeSheetApprove');
  Route::get('/administrator/timesheet/reject', 'Administrator\TimesheetController@timeSheetReject');
  // Hours
  Route::get('/administrator/hours', 'Administrator\HoursController@hours');


// Deputy
  // Timesheet
  Route::get('/deputy/timesheet', 'Deputy\TimesheetController@timesheet');
  Route::get('/deputy/timesheet/approve', 'Deputy\TimesheetController@timesheetApprove');
  Route::get('/deputy/timesheet/reject', 'Deputy\TimesheetController@timesheetReject');


// Coordinator
  // Uos
  Route::get('/coordinator/uos', 'Coordinator\UosController@Uos');
  Route::post('/coordinator/uos/store', 'Coordinator\UosController@UosStore');
  Route::get('/coordinator/uos/page', 'Coordinator\UosController@UosPage');
  Route::post('/coordinator/uos/page/tutor/store', 'Coordinator\UosController@UosPageTutorStore');
  Route::get('/coordinator/uos/page/tutor/delete', 'Coordinator\UosController@UosPageTutorDelete');
  Route::get('/coordinator/uos/page/tutor/timesheet', 'Coordinator\UosController@UosPageTutorTimeSheet');
  Route::post('/coordinator/uos/page/tutor/timesheet/tutorial/store', 'Coordinator\UosController@UosPageTutorTimeSheetTutorialStore');
  Route::post('/coordinator/uos/page/tutor/timesheet/other/store', 'Coordinator\UosController@UosPageTutorTimeSheetOtherStore');
  Route::post('/coordinator/uos/page/tutorial/store', 'Coordinator\UosController@UosPageTutorialStore');
  Route::get('/coordinator/uos/page/tutorial/delete', 'Coordinator\UosController@UosPageTutorialDelete');
  Route::post('/coordinator/uos/page/tutorial/tutor/store', 'Coordinator\UosController@UosPageTutorialTutorStore');
  // Tutor
  Route::get('/coordinator/tutor', 'Coordinator\TutorController@tutor');
  Route::get('/coordinator/tutor/create', 'Coordinator\TutorController@tutorCreate');
  Route::post('/coordinator/tutor/store', 'Coordinator\TutorController@tutorStore');
  // Timesheet
  Route::get('/coordinator/timesheet', 'Coordinator\TimesheetController@timesheet');
  Route::get('/coordinator/timesheet/approve', 'Coordinator\TimesheetController@timeSheetApprove');
  Route::get('/coordinator/timesheet/reject', 'Coordinator\TimesheetController@timeSheetReject');


// Casual Academic
  // Uos
  Route::get('/tutor/uos', 'Tutor\UosController@Uos');
  Route::get('/tutor/uos/page', 'Tutor\UosController@UosPage');
  Route::post('/tutor/uos/page/timesheet/store', 'Tutor\UosController@UosPageTimesheetStore');
  Route::post('/tutor/uos/page/timesheet/update', 'Tutor\UosController@UosPageTimesheetUpdate');
  Route::post('/tutor/uos/page/preference/store', 'Tutor\UosController@UosPagePreferenceStore');
  // Time sheet
  Route::get('/tutor/timesheet', 'Tutor\TimesheetController@timesheet');
  // Tutorial
  Route::get('/tutor/tutorial', 'Tutor\TutorialController@tutorial');


// Notification
Route::get('/notification', 'Notification\NotificationController@notification');
Route::get('/notification/mark', 'Notification\NotificationController@notificationMark');
Route::get('/notification/markall', 'Notification\NotificationController@notificationMarkAll');


Route::get('/test/data/generate', 'Test\DataController@dataGenerate');
