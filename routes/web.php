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
  Route::post('/administrator/uos/store ', 'Administrator\UosController@UosStore');
  Route::get('/administrator/uos/page ', 'Administrator\UosController@UosPage');
  Route::post('/administrator/uos/page/tutor/store ', 'Administrator\UosController@UosPageTutorStore');
  Route::get('/administrator/uos/page/tutor/delete ', 'Administrator\UosController@UosPageTutorDelete');
  Route::get('/administrator/uos/page/tutor/timesheet ', 'Administrator\UosController@UosPageTutorTimeSheet');
  Route::post('/administrator/uos/page/tutorial/store ', 'Administrator\UosController@UosPageTutorialStore');
  Route::get('/administrator/uos/page/tutorial/delete ', 'Administrator\UosController@UosPageTutorialDelete');
  Route::post('/administrator/uos/page/coordinator/store ', 'Administrator\UosController@UosPageCoordinatorStore');
  Route::get('/administrator/uos/page/coordinator/delete ', 'Administrator\UosController@UosPageCoordinatorDelete');
  Route::post('/administrator/uos/page/tutorial/tutor/store ', 'Administrator\UosController@UosPageTutorialTutorStore');


// Deputy


// Coordinator
  // Uos
  Route::get('/coordinator/uos', 'Coordinator\UosController@Uos');
  Route::get('/coordinator/uos/page ', 'Coordinator\UosController@UosPage');
  Route::post('/coordinator/uos/page/tutor/store ', 'Coordinator\UosController@UosPageTutorStore');
  Route::get('/coordinator/uos/page/tutor/delete ', 'Coordinator\UosController@UosPageTutorDelete');
  Route::post('/coordinator/uos/page/tutorial/store ', 'Coordinator\UosController@UosPageTutorialStore');
  Route::get('/coordinator/uos/page/tutorial/delete ', 'Coordinator\UosController@UosPageTutorialDelete');
  Route::post('/coordinator/uos/page/tutorial/tutor/store ', 'Coordinator\UosController@UosPageTutorialTutorStore');


// Casual Academic
  // Uos
  Route::get('/tutor/uos', 'Tutor\UosController@Uos');
  Route::get('/tutor/uos/page ', 'Tutor\UosController@UosPage');
  Route::post('/tutor/uos/page/preference/store', 'Tutor\UosController@UosPagePreferenceStore');
